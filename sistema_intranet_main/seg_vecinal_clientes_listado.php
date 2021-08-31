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
$original = "seg_vecinal_clientes_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){            $location .= "&idTipo=".$_GET['idTipo'];              $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){            $location .= "&Nombre=".$_GET['Nombre'];              $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['Rut']) && $_GET['Rut'] != ''){                  $location .= "&Rut=".$_GET['Rut'];                    $search .= "&Rut=".$_GET['Rut'];}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento'] != ''){  $location .= "&fNacimiento=".$_GET['fNacimiento'];    $search .= "&fNacimiento=".$_GET['fNacimiento'];}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){        $location .= "&idCiudad=".$_GET['idCiudad'];          $search .= "&idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){        $location .= "&idComuna=".$_GET['idComuna'];          $search .= "&idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){      $location .= "&Direccion=".$_GET['Direccion'];        $search .= "&Direccion=".$_GET['Direccion'];}
if(isset($_GET['Giro']) && $_GET['Giro'] != ''){                $location .= "&Giro=".$_GET['Giro'];                  $search .= "&Giro=".$_GET['Giro'];}
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
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_clientes_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/seg_vecinal_clientes_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Vecino creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Vecino editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Vecino borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
//valido los permisos
validaPermisoUser($rowlevel['level'], 2, $dbConn);
// consulto los datos
$query = "SELECT  
seg_vecinal_clientes_listado.email, 
seg_vecinal_clientes_listado.Nombre, 
seg_vecinal_clientes_listado.Rut, 
seg_vecinal_clientes_listado.RazonSocial, 
seg_vecinal_clientes_listado.fNacimiento, 
seg_vecinal_clientes_listado.Direccion, 
seg_vecinal_clientes_listado.Fono1, 
seg_vecinal_clientes_listado.Fono2, 
seg_vecinal_clientes_listado.Fax,
seg_vecinal_clientes_listado.PersonaContacto,
seg_vecinal_clientes_listado.PersonaContacto_Fono,
seg_vecinal_clientes_listado.PersonaContacto_email,
seg_vecinal_clientes_listado.PersonaContacto_Cargo,
seg_vecinal_clientes_listado.Web,
seg_vecinal_clientes_listado.Giro,
seg_vecinal_clientes_listado.idTipo,
core_ubicacion_ciudad.Nombre AS nombre_region,
core_ubicacion_comunas.Nombre AS nombre_comuna,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
seg_vecinal_clientes_tipos.Nombre AS tipoVecino,
core_rubros.Nombre AS Rubro,
core_sistemas_opciones.Nombre AS Compartir

FROM `seg_vecinal_clientes_listado`
LEFT JOIN `core_estados`                 ON core_estados.idEstado                    = seg_vecinal_clientes_listado.idEstado
LEFT JOIN `core_ubicacion_ciudad`        ON core_ubicacion_ciudad.idCiudad           = seg_vecinal_clientes_listado.idCiudad
LEFT JOIN `core_ubicacion_comunas`       ON core_ubicacion_comunas.idComuna          = seg_vecinal_clientes_listado.idComuna
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                  = seg_vecinal_clientes_listado.idSistema
LEFT JOIN `seg_vecinal_clientes_tipos`   ON seg_vecinal_clientes_tipos.idTipo        = seg_vecinal_clientes_listado.idTipo
LEFT JOIN `core_rubros`                  ON core_rubros.idRubro                      = seg_vecinal_clientes_listado.idRubro
LEFT JOIN `core_sistemas_opciones`       ON core_sistemas_opciones.idOpciones        = seg_vecinal_clientes_listado.idCompartir
WHERE seg_vecinal_clientes_listado.idCliente = ".$_GET['id'];
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
	<?php echo widget_title('bg-aqua', 'fa-cog', 100, 'Vecino', $rowdata['Nombre'], 'Resumen');?>
</div>
<div class="clearfix"></div> 

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'seg_vecinal_clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-bars" aria-hidden="true"></i> Resumen</a></li>
				<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-address-book-o" aria-hidden="true"></i> Datos Contacto</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i> Ver mas <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_datos_persona_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Persona Contacto</a></li>
						<?php if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
							<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_datos_comerciales.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-usd" aria-hidden="true"></i> Datos Comerciales</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-power-off" aria-hidden="true"></i> Estado</a></li>
						<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_verificacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-check-square-o" aria-hidden="true"></i> Verificacion</a></li>
						<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_observaciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Observaciones</a></li>
						<li class=""><a href="<?php echo 'seg_vecinal_clientes_listado_password.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" ><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
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
								<strong>Tipo de Vecino : </strong><?php echo $rowdata['tipoVecino']; ?><br/>
								<?php 
								//Si el cliente es una empresa
								if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
									<strong>Nombre Fantasia: </strong><?php echo $rowdata['Nombre']; ?><br/>
								<?php 
								//si es una persona
								}else{ ?>
									<strong>Nombre: </strong><?php echo $rowdata['Nombre']; ?><br/>
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
								<?php } ?>
								<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
								<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
								<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
								<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
								<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?><br/>
								<strong>Estado : </strong><?php echo $rowdata['estado']; ?>
							</p>
									
							<?php 
							//Si el cliente es una empresa
							if(isset($rowdata['idTipo'])&&$rowdata['idTipo']==1){?>
								<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Comerciales</h2>
								<p class="text-muted word_break">
									<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
									<strong>Razon Social : </strong><?php echo $rowdata['RazonSocial']; ?><br/>
									<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
									<strong>Rubro : </strong><?php echo $rowdata['Rubro']; ?><br/>
								</p>
							<?php } ?>
										
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Compartir Datos de Contacto : </strong><?php echo $rowdata['Compartir']; ?><br/>
								<strong>Telefono Fijo : </strong><?php echo $rowdata['Fono1']; ?><br/>
								<strong>Telefono Movil : </strong><?php echo $rowdata['Fono2']; ?><br/>
								<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
								<strong>Web : </strong><a target="_blank" rel="noopener noreferrer" href="https://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
							</p>
									
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Persona de Contacto</h2>
							<p class="text-muted word_break">
								<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
								<strong>Cargo Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto_Cargo']; ?><br/>
								<strong>Telefono : </strong><?php echo $rowdata['PersonaContacto_Fono']; ?><br/>
								<strong>Email : </strong><a href="mailto:<?php echo $rowdata['PersonaContacto_email']; ?>"><?php echo $rowdata['PersonaContacto_email']; ?></a><br/>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<?php 
							//se arma la direccion
							$direccion = "";
							if(isset($rowdata["Direccion"])&&$rowdata["Direccion"]!=''){           $direccion .= $rowdata["Direccion"];}
							if(isset($rowdata["nombre_comuna"])&&$rowdata["nombre_comuna"]!=''){   $direccion .= ', '.$rowdata["nombre_comuna"];}
							if(isset($rowdata["nombre_region"])&&$rowdata["nombre_region"]!=''){   $direccion .= ', '.$rowdata["nombre_region"];}
							//se despliega mensaje en caso de no existir direccion
							if($direccion!=''){
								echo mapa_from_direccion($direccion, 0, $_SESSION['usuario']['basic_data']['Config_IDGoogle'], 18, 1); 
							}else{
								$Alert_Text = 'No tiene una direccion definida';
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
			<h5>Crear Vecino</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = '';}
				if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = '';}
				if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = '';}
				if(isset($idCiudad)) {         $x5  = $idCiudad;          }else{$x5  = '';}
				if(isset($idComuna)) {         $x6  = $idComuna;          }else{$x6  = '';}
				if(isset($Direccion)) {        $x7  = $Direccion;         }else{$x7  = '';}
				if(isset($Giro)) {             $x8  = $Giro;              }else{$x8  = '';}

				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_tittle(3, 'Datos Basicos');
				$Form_Inputs->form_select('Tipo de Vecino','idTipo', $x1, 2, 'idTipo', 'Nombre', 'seg_vecinal_clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 2);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x3, 1);
				$Form_Inputs->form_date('F Ingreso Sistema','fNacimiento', $x4, 1);
				$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x5, 2, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
												  'Comuna','idComuna', $x6, 2, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
												  $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x7, 2,'fa fa-map');	 
				$Form_Inputs->form_input_icon('Giro de la empresa', 'Giro', $x8, 1,'fa fa-industry');
				
				$Form_Inputs->form_input_disabled('Empresa Relacionada','fake_emp', $_SESSION['usuario']['basic_data']['RazonSocial']);
				$Form_Inputs->form_input_hidden('idSistema', $_SESSION['usuario']['basic_data']['idSistema'], 2);
				$Form_Inputs->form_input_hidden('idEstado', 1, 2);
				$Form_Inputs->form_input_hidden('password', 1234, 2);
				$Form_Inputs->form_input_hidden('idCompartir', 2, 2);
				
				
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
		case 'rut_asc':         $order_by = 'ORDER BY seg_vecinal_clientes_listado.Rut ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Rut Ascendente'; break;
		case 'rut_desc':        $order_by = 'ORDER BY seg_vecinal_clientes_listado.Rut DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Rut Descendente';break;
		case 'nombre_asc':      $order_by = 'ORDER BY seg_vecinal_clientes_listado.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':     $order_by = 'ORDER BY seg_vecinal_clientes_listado.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'estado_asc':      $order_by = 'ORDER BY seg_vecinal_clientes_listado.idEstado ASC ';  $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':     $order_by = 'ORDER BY seg_vecinal_clientes_listado.idEstado DESC '; $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		case 'verificado_asc':  $order_by = 'ORDER BY core_seguridad_verificacion.Nombre ASC ';     $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Verificacion Ascendente';break;
		case 'verificado_desc': $order_by = 'ORDER BY core_seguridad_verificacion.Nombre DESC ';    $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Verificacion Descendente';break;
		
		default: $order_by = 'ORDER BY seg_vecinal_clientes_listado.idVerificado ASC, seg_vecinal_clientes_listado.idEstado ASC, seg_vecinal_clientes_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Verificacion, Estado, Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY seg_vecinal_clientes_listado.idVerificado ASC,seg_vecinal_clientes_listado.idEstado ASC,  seg_vecinal_clientes_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Verificacion, Estado, Nombre Ascendente';
}
/**********************************************************/
//Variable de busqueda
$z = "WHERE seg_vecinal_clientes_listado.idSistema=".$_SESSION['usuario']['basic_data']['idSistema'];	

/**********************************************************/
//Se aplican los filtros
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){              $z .= " AND seg_vecinal_clientes_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){              $z .= " AND seg_vecinal_clientes_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['Rut']) && $_GET['Rut'] != ''){                    $z .= " AND seg_vecinal_clientes_listado.Rut LIKE '%".$_GET['Rut']."%'";}
if(isset($_GET['fNacimiento']) && $_GET['fNacimiento'] != ''){    $z .= " AND seg_vecinal_clientes_listado.fNacimiento='".$_GET['fNacimiento']."'";}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){          $z .= " AND seg_vecinal_clientes_listado.idCiudad=".$_GET['idCiudad'];}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){          $z .= " AND seg_vecinal_clientes_listado.idComuna=".$_GET['idComuna'];}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != ''){        $z .= " AND seg_vecinal_clientes_listado.Direccion LIKE '%".$_GET['Direccion']."%'";}
if(isset($_GET['Giro']) && $_GET['Giro'] != ''){                  $z .= " AND seg_vecinal_clientes_listado.Giro LIKE '%".$_GET['Giro']."%'";}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){          $z .= " AND seg_vecinal_clientes_listado.idEstado=".$_GET['idEstado'];}
if(isset($_GET['idVerificado']) && $_GET['idVerificado'] != ''){  $z .= " AND seg_vecinal_clientes_listado.idVerificado=".$_GET['idVerificado'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT seg_vecinal_clientes_listado.idCliente FROM `seg_vecinal_clientes_listado` ".$z;
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
// Se trae un listado con todos los elementos
$arrUsers = array();
$query = "SELECT 
seg_vecinal_clientes_listado.idCliente,
seg_vecinal_clientes_listado.Rut,
seg_vecinal_clientes_listado.Nombre,
core_estados.Nombre AS estado,
core_sistemas.Nombre AS sistema,
seg_vecinal_clientes_listado.idEstado,
seg_vecinal_clientes_listado.idVerificado,
core_seguridad_verificacion.Nombre AS verificado

FROM `seg_vecinal_clientes_listado`
LEFT JOIN `core_estados`                 ON core_estados.idEstado                      = seg_vecinal_clientes_listado.idEstado
LEFT JOIN `core_sistemas`                ON core_sistemas.idSistema                    = seg_vecinal_clientes_listado.idSistema
LEFT JOIN `core_seguridad_verificacion`  ON core_seguridad_verificacion.idVerificado   = seg_vecinal_clientes_listado.idVerificado

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
		<li class="btn btn-default tooltip" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Presionar para desplegar Formulario de Busqueda" style="font-size: 14px;"><i class="fa fa-search faa-vertical animated" aria-hidden="true"></i></li>
		<li class="btn btn-default"><?php echo $bread_order; ?></li>
		<?php if(isset($_GET['filtro_form'])&&$_GET['filtro_form']!=''){ ?>
			<li class="btn btn-danger"><a href="<?php echo $original.'?pagina=1'; ?>" style="color:#fff;"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a></li>
		<?php } ?>		
	</ul>
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Vecino</a><?php }?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = '';}
				if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = '';}
				if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = '';}
				if(isset($idCiudad)) {         $x5  = $idCiudad;          }else{$x5  = '';}
				if(isset($idComuna)) {         $x6  = $idComuna;          }else{$x6  = '';}
				if(isset($Direccion)) {        $x7  = $Direccion;         }else{$x7  = '';}
				if(isset($Giro)) {             $x9  = $Giro;              }else{$x9  = '';}
				if(isset($idEstado)) {         $x10 = $idEstado;          }else{$x10 = '';}
				if(isset($idVerificado)) {     $x11 = $idVerificado;      }else{$x11 = '';}
				
				//se dibujan los inputs
				$Form_Inputs = new Form_Inputs();
				$Form_Inputs->form_select('Tipo de Vecino','idTipo', $x1, 1, 'idTipo', 'Nombre', 'seg_vecinal_clientes_tipos', 0, '', $dbConn);
				$Form_Inputs->form_input_text('Nombres', 'Nombre', $x2, 1);
				$Form_Inputs->form_input_rut('Rut', 'Rut', $x3, 1);
				$Form_Inputs->form_date('F Ingreso Sistema','fNacimiento', $x4, 1);
				$Form_Inputs->form_select_depend1('Ciudad','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'core_ubicacion_ciudad', 0, 0,
										'Comuna','idComuna', $x6, 1, 'idComuna', 'Nombre', 'core_ubicacion_comunas', 0, 0, 
										 $dbConn, 'form1');
				$Form_Inputs->form_input_icon('Direccion', 'Direccion', $x7, 1,'fa fa-map');	 
				$Form_Inputs->form_input_icon('Giro de la empresa', 'Giro', $x9, 1,'fa fa-industry');
				$Form_Inputs->form_select('Estado','idEstado', $x10, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
				$Form_Inputs->form_select('Verificacion','idVerificado', $x11, 1, 'idVerificado', 'Nombre', 'core_seguridad_verificacion', 0, '', $dbConn);
				
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
			<div class="icons"><i class="fa fa-table" aria-hidden="true"></i></div><h5>Listado de Vecinos</h5>	
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
							<div class="pull-left">Rut</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=rut_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=rut_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=nombre_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=nombre_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Estado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=estado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=estado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<th width="120">
							<div class="pull-left">Verificado</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=verificado_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
								<a href="<?php echo $location.'&order_by=verificado_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></a>
							</div>
						</th>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><th width="160">Sistema</th><?php } ?>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Rut']; ?></td>		
						<td><?php echo $usuarios['Nombre']; ?></td>		
						<td><label class="label <?php if(isset($usuarios['idEstado'])&&$usuarios['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['estado']; ?></label></td>		
						<td><label class="label <?php if(isset($usuarios['idVerificado'])&&$usuarios['idVerificado']==2){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $usuarios['verificado']; ?></label></td>
						<?php if($_SESSION['usuario']['basic_data']['idTipoUsuario']==1){ ?><td><?php echo $usuarios['sistema']; ?></td><?php } ?>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_seg_vecinal_cliente.php?view='.simpleEncode($usuarios['idCliente'], fecha_actual()); ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idCliente']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.simpleEncode($usuarios['idCliente'], fecha_actual());
									$dialogo   = '¿Realmente deseas eliminar al Vecino '.$usuarios['Nombre'].'?';?>
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
