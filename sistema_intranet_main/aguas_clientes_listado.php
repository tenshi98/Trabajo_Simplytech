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
$original = "aguas_clientes_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){  $location .= "&Identificador=".$_GET['Identificador'];   $search .= "&Identificador=".$_GET['Identificador'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                $location .= "&Nombre=".$_GET['Nombre'];                 $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                $location .= "&idTipo=".$_GET['idTipo'];                 $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['idFacturable']) && $_GET['idFacturable'] != ''){    $location .= "&idFacturable=".$_GET['idFacturable'];     $search .= "&idFacturable=".$_GET['idFacturable'];}
if(isset($_GET['idSector']) && $_GET['idSector'] != ''){            $location .= "&idSector=".$_GET['idSector'];             $search .= "&idSector=".$_GET['idSector'];}
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
	require_once 'A1XRXS_sys/xrxs_form/aguas_clientes_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Cliente creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Cliente editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Cliente borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT  
aguas_clientes_listado.email, 
aguas_clientes_listado.Nombre, 
aguas_clientes_listado.Rut, 
aguas_clientes_listado.RazonSocial, 
aguas_clientes_listado.fNacimiento, 
aguas_clientes_listado.Direccion, 
aguas_clientes_listado.Fono1, 
aguas_clientes_listado.Fono2, 
aguas_clientes_listado.Fax,
aguas_clientes_listado.PersonaContacto,
aguas_clientes_listado.PersonaContacto_Fono,
aguas_clientes_listado.PersonaContacto_email,
aguas_clientes_listado.Web,
aguas_clientes_listado.Giro,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
aguas_clientes_tipos.Nombre AS tipoCliente,
core_rubros.Nombre AS Rubro,
aguas_clientes_listado.UnidadHabitacional,
aguas_clientes_listado.Identificador,
aguas_clientes_listado.Arranque,
aguas_clientes_listado.latitud,
aguas_clientes_listado.longitud,
aguas_marcadores_listado.Nombre AS medidor,
aguas_marcadores_remarcadores.Nombre AS remarcador,
aguas_clientes_estadopago.Nombre AS EstadoPago,
aguas_clientes_facturable.Nombre AS DocFacturable,
ciudad.Nombre AS nombre_region_fact,
comuna.Nombre AS nombre_comuna_fact,
aguas_clientes_listado.DireccionFact,
aguas_clientes_listado.RazonSocial,
aguas_analisis_aguas_tipo_punto_muestreo.Nombre AS TipoPunto,
aguas_analisis_sectores.Nombre AS Sector

FROM `aguas_clientes_listado`
LEFT JOIN `core_estados`                              ON core_estados.idEstado                                      = aguas_clientes_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`                     ON core_ubicacion_ciudad.idCiudad                             = aguas_clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`                    ON core_ubicacion_comunas.idComuna                            = aguas_clientes_listado.idComuna
LEFT JOIN `core_sistemas`                             ON core_sistemas.idSistema                                    = aguas_clientes_listado.idSistema
LEFT JOIN `aguas_clientes_tipos`                      ON aguas_clientes_tipos.idTipo                                = aguas_clientes_listado.idTipo
LEFT JOIN `core_rubros`                               ON core_rubros.idRubro                                        = aguas_clientes_listado.idRubro
LEFT JOIN `aguas_marcadores_listado`                  ON aguas_marcadores_listado.idMarcadores                      = aguas_clientes_listado.idMarcadores
LEFT JOIN `aguas_marcadores_remarcadores`             ON aguas_marcadores_remarcadores.idRemarcadores               = aguas_clientes_listado.idRemarcadores
LEFT JOIN `aguas_clientes_estadopago`                 ON aguas_clientes_estadopago.idEstadoPago                     = aguas_clientes_listado.idEstadoPago
LEFT JOIN `aguas_clientes_facturable`                 ON aguas_clientes_facturable.idFacturable                     = aguas_clientes_listado.idFacturable
LEFT JOIN `core_ubicacion_ciudad`   ciudad            ON ciudad.idCiudad                                            = aguas_clientes_listado.idCiudadFact
LEFT JOIN `core_ubicacion_comunas`  comuna            ON comuna.idComuna                                            = aguas_clientes_listado.idComunaFact
LEFT JOIN `aguas_analisis_aguas_tipo_punto_muestreo`  ON aguas_analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo   = aguas_clientes_listado.idPuntoMuestreo
LEFT JOIN `aguas_analisis_sectores`                   ON aguas_analisis_sectores.idSector                           = aguas_clientes_listado.idSector

WHERE aguas_clientes_listado.idCliente = ".$_GET['id'];
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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Cliente '.$rowdata['Identificador'], $rowdata['Nombre'], 'Resumen');?>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'aguas_clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'aguas_clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
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
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="col-sm-6">
					<div class="row" style="border-right: 1px solid #333;">
						<div class="col-sm-12">
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Basicos</h2>
							<p class="text-muted word_break">
								<strong>Tipo de Cliente : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
								<strong>Nombre: </strong><?php echo $rowdata['Nombre']; ?><br/>
								<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
								<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
								<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
								<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
								<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
								<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
							</p>
										
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Telefono Fijo : </strong><?php echo $rowdata['Fono1']; ?><br/>
								<strong>Telefono Movil : </strong><?php echo $rowdata['Fono2']; ?><br/>
								<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
								<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="https://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Persona de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
								<strong>Telefono : </strong><?php echo $rowdata['PersonaContacto_Fono']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Facturacion</h2>
							<p class="text-muted word_break">
								<strong>Identificador : </strong><?php echo $rowdata['Identificador']; ?><br/>
								<strong>ID medidor : </strong><?php echo $rowdata['medidor']; ?><br/>
								<strong>ID remarcador : </strong><?php echo $rowdata['remarcador']; ?><br/>
								<strong>Unidades Habitacionales : </strong><?php echo $rowdata['UnidadHabitacional']; ?><br/>
								<strong>Arranque : </strong><?php echo $rowdata['Arranque']; ?><br/>
								<strong>Estado : </strong><?php echo $rowdata['EstadoPago']; ?><br/>
								<strong>Forma Facturacion : </strong><?php echo $rowdata['DocFacturable']; ?><br/>
								<strong>Region Facturacion : </strong><?php echo $rowdata['nombre_region_fact']; ?><br/>
								<strong>Ciudad Facturacion : </strong><?php echo $rowdata['nombre_comuna_fact']; ?><br/>
								<strong>Direccion Facturacion : </strong><?php echo $rowdata['DireccionFact']; ?><br/>
								<strong>Giro de la empresa : </strong><?php echo $rowdata['Giro']; ?><br/>
								<strong>Rubro de la empresa : </strong><?php echo $rowdata['Rubro']; ?><br/>
								<strong>Razon Social de la empresa : </strong><?php echo $rowdata['RazonSocial']; ?><br/>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Medicion</h2>
							<p class="text-muted word_break">
								<strong>Sector : </strong><?php echo $rowdata['Sector']; ?><br/>
								<strong>Tipo de Medicion : </strong><?php echo $rowdata['TipoPunto']; ?><br/>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<?php 
							//se despliega mensaje en caso de no existir direccion
							if($rowdata["latitud"]!=0 && $rowdata["longitud"]!=0){
								echo mapa_from_gps($rowdata["latitud"], $rowdata["longitud"], $rowdata['Identificador'], $rowdata['Nombre'], $rowdata['Direccion'], $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1);
							}else{
								$Alert_Text = 'No tiene latitud y longitud definida';
								alert_post_data(4,2,2, $Alert_Text);
							}
						?>
					</div>
				</div>
				<div class="clearfix"></div>
				
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) {
//valido los permisos
validaPermisoUser($rowlevel['level'], 3, $dbConn); ?>

<div class="col-sm-8 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit" aria-hidden="true"></i></div>		
			<h5>Crear Cliente</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = '';}
				if(isset($Identificador)) {    $x2  = $Identificador;     }else{$x2  = '';}
				if(isset($Nombre)) {           $x3  = $Nombre;            }else{$x3  = '';}
				if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = '';}
				if(isset($idCiudad)) {         $x5  = $idCiudad;          }else{$x5  = '';}
				if(isset($idComuna)) {         $x6  = $idComuna;          }else{$x6  = '';}
				if(isset($Direccion)) {        $x7  = $Direccion;         }else{$x7  = '';}
				if(isset($Giro)) {             $x8  = $Giro;              }else{$x8  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_select('Tipo de Cliente','idTipo', $x1, 2, 'idTipo', 'Nombre', 'aguas_clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_text('Identificador', 'Identificador', $x2, 2);
				$Form_Inputs->form_input_text('Nombre', 'Nombre', $x3, 2);
				
				$Form_Inputs->form_tittle(3, 'Datos Opcionales');
				$Form_Inputs->form_date('Fecha Ingreso Sistema','fNacimiento', $x4, 1);
				$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x6, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x7, 1,'fa fa-map');	 
				$Form_Inputs->form_input_icon('Giro de la empresa', 'Giro', $x8, 1,'fa fa-industry');
				
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				$Form_Inputs->form_input_hidden('idEstadoPago', 1, 2);
				?>
								
				<div class="form-group">	
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>		
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
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
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
		case 'identificador_asc':   $order_by = 'aguas_clientes_listado.Identificador ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente'; break;
		case 'identificador_desc':  $order_by = 'aguas_clientes_listado.Identificador DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Identificador Descendente';break;
		case 'nombre_asc':          $order_by = 'aguas_clientes_listado.Nombre ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':         $order_by = 'aguas_clientes_listado.Nombre DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'tipo_asc':            $order_by = 'aguas_clientes_tipos.Nombre ASC ';                $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Ascendente';break;
		case 'tipo_desc':           $order_by = 'aguas_clientes_tipos.Nombre DESC ';               $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Descendente';break;
		case 'forma_asc':           $order_by = 'aguas_clientes_facturable.Nombre ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Forma de Facturacion Ascendente';break;
		case 'forma_desc':          $order_by = 'aguas_clientes_facturable.Nombre DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Forma de Facturacion Descendente';break;
		case 'estado_asc':          $order_by = 'aguas_clientes_listado.idEstado ASC ';            $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':         $order_by = 'aguas_clientes_listado.idEstado DESC ';           $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'aguas_clientes_listado.Identificador ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente';
	}
}else{
	$order_by = 'aguas_clientes_listado.Identificador ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Identificador Ascendente';
}
/**********************************************************/
//Variable de busqueda
$SIS_where = "aguas_clientes_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Identificador']) && $_GET['Identificador'] != ''){  $SIS_where .= " AND aguas_clientes_listado.Identificador LIKE '%".$_GET['Identificador']."%'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                $SIS_where .= " AND aguas_clientes_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                $SIS_where .= " AND aguas_clientes_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['idFacturable']) && $_GET['idFacturable'] != ''){    $SIS_where .= " AND aguas_clientes_listado.idFacturable=".$_GET['idFacturable'];}
if(isset($_GET['idSector']) && $_GET['idSector'] != ''){            $SIS_where .= " AND aguas_clientes_listado.idSector=".$_GET['idSector'];}

/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$cuenta_registros = db_select_nrows (false, 'aguas_clientes_listado.idCliente', 'aguas_clientes_listado', '', $SIS_where, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'cuenta_registros');
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los elementos
$SIS_query = '
aguas_clientes_listado.idCliente,
aguas_clientes_listado.Identificador,
aguas_clientes_listado.Nombre,
aguas_clientes_listado.idEstado,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
aguas_clientes_facturable.Nombre AS DocFacturable,
aguas_clientes_tipos.Nombre AS Tipo';
$SIS_join  = '
LEFT JOIN `core_estados`               ON core_estados.idEstado                    = aguas_clientes_listado.idEstado
LEFT JOIN `core_sistemas`              ON core_sistemas.idSistema                  = aguas_clientes_listado.idSistema
LEFT JOIN `aguas_clientes_facturable`  ON aguas_clientes_facturable.idFacturable   = aguas_clientes_listado.idFacturable
LEFT JOIN `aguas_clientes_tipos`       ON aguas_clientes_tipos.idTipo              = aguas_clientes_listado.idTipo';
$SIS_order = $order_by.' LIMIT '.$comienzo.', '.$cant_reg;
$arrUsers = array();
$arrUsers = db_select_array (false, $SIS_query, 'aguas_clientes_listado', $SIS_join, $SIS_where, $SIS_order, $dbConn, $_SESSION['usuario']['basic_data']['Nombre'], $original, 'arrUsers');

?>

<div class="col-sm-12 breadcrumb-bar">

	<ul class="btn-group btn-breadcrumb pull-left">
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Cliente</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Identificador)) {    $x1  = $Identificador;     }else{$x1  = '';}
				if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($idTipo)) {           $x3  = $idTipo;            }else{$x3  = '';}
				if(isset($idFacturable)) {     $x4  = $idFacturable;      }else{$x4  = '';}
				if(isset($idSector)) {         $x5  = $idSector;          }else{$x5  = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_input_text('Identificador', 'Identificador', $x1, 1);
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 1);
				$Form_Inputs->form_select('Tipo de Cliente','idTipo', $x3, 1, 'idTipo', 'Nombre', 'aguas_clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_select('Forma Facturacion','idFacturable', $x4, 1, 'idFacturable', 'Nombre', 'aguas_clientes_facturable', 0, '', $dbConn);
				$Form_Inputs->form_select('Sector','idSector', $x5, 1, 'idSector', 'Nombre', 'aguas_analisis_sectores', 0, '', $dbConn);
					
				$Form_Inputs->form_input_hidden('pagina', $_GET['pagina'], 1);
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Clientes</h5>	
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
							<div class="pull-left">Identificador</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=identificador_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=identificador_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tipo</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Forma Facturacion</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=forma_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=forma_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Identificador']; ?></td>		
						<td><?php echo $usuarios['Nombre']; ?></td>		
						<td><?php echo $usuarios['Tipo']; ?></td>		
						<td><?php echo $usuarios['DocFacturable']; ?></td>		
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['estado']; ?></label></td>		
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_aguas_cliente.php?view='.simpleEncode($usuarios['idCliente'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idCliente']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($usuarios['idCliente'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar al cliente '.$usuarios['Nombre'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" title="Borrar Informacion" class="btn btn-metis-1 btn-sm tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
