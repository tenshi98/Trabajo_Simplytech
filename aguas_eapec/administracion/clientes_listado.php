<?php session_start();
/**********************************************************************************************************************************/
/*                                           Se define la variable de seguridad                                                   */
/**********************************************************************************************************************************/
define('XMBCXRXSKGC', 1);
/**********************************************************************************************************************************/
/*                                                          Seguridad                                                             */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/AntiXSS.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/Bootup.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_seguridad/UTF8.php';
$security = new AntiXSS();
$_POST = $security->xss_clean($_POST);
$_GET  = $security->xss_clean($_GET);
/**********************************************************************************************************************************/
/*                                          Se llaman a los archivos necesarios                                                   */
/**********************************************************************************************************************************/
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/config.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/conexion.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/esUsuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/web_carga_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/sesion_usuario.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/functions.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "clientes_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idTipo,Nombre,Direccion,idSistema';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/clientes_listado.php';	
}

?>
<?php require_once 'core/header.php';?>
    <div id="wrap">
      <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>
              <a href="principal.php" class="navbar-brand">
                <?php require_once 'core/logo_empresa.php';?>
              </a> 
            </header>
            <?php require_once 'core/infobox.php';?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <?php require_once 'core/menu_top.php';?>
            </div>
          </div>
        </nav>
        <header class="head">
          <div class="main-bar">
            <h3><?php echo '<i class="'.$rowlevel['IconoCategoria'].'"></i> '.$rowlevel['nombre_categoria'].' - '.$rowlevel['nombre_transaccion']; ?></h3>
          </div>
        </header>
      </div>
      <div id="left">
       <?php require_once 'core/userbox.php';?> 
       <?php require_once 'core/menu.php';?> 
      </div>
      <div id="content">
        <div class="outer">
            <div class="inner">
			<!-- InstanceBeginEditable name="Bodytext" -->
<?php 
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Cliente creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Cliente editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Cliente borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT  
clientes_listado.email, 
clientes_listado.Nombre, 
clientes_listado.Rut, 
clientes_listado.fNacimiento, 
clientes_listado.Direccion, 
clientes_listado.Fono1, 
clientes_listado.Fono2, 
clientes_listado.Fax,
clientes_listado.PersonaContacto,
clientes_listado.Web,
clientes_listado.Giro,
clientes_listado.UnidadHabitacional,
clientes_listado.Identificador,
clientes_listado.Arranque,
clientes_listado.latitud,
clientes_listado.longitud,
mnt_ubicacion_ciudad.Nombre AS nombre_region,
mnt_ubicacion_comunas.Nombre AS nombre_comuna,
clientes_estado.Nombre AS estado,
core_sistemas.Nombre AS sistema,
clientes_tipos.Nombre AS tipoCliente,
marcadores_listado.Nombre AS medidor,
marcadores_remarcadores.Nombre AS remarcador,
clientes_estadopago.Nombre AS EstadoPago,
clientes_facturable.Nombre AS DocFacturable,
ciudad.Nombre AS nombre_region_fact,
comuna.Nombre AS nombre_comuna_fact,
clientes_listado.DireccionFact,
clientes_listado.RazonSocial,
analisis_aguas_tipo_punto_muestreo.Nombre AS TipoPunto,
analisis_sectores.Nombre AS Sector

FROM `clientes_listado`
LEFT JOIN `clientes_estado`                     ON clientes_estado.idEstado                             = clientes_listado.idEstado
LEFT JOIN `mnt_ubicacion_ciudad`                ON mnt_ubicacion_ciudad.idCiudad                        = clientes_listado.idCiudad
LEFT JOIN `mnt_ubicacion_comunas`               ON mnt_ubicacion_comunas.idComuna                       = clientes_listado.idComuna
LEFT JOIN `core_sistemas`                       ON core_sistemas.idSistema                              = clientes_listado.idSistema
LEFT JOIN `clientes_tipos`                      ON clientes_tipos.idTipo                                = clientes_listado.idTipo
LEFT JOIN `marcadores_listado`                  ON marcadores_listado.idMarcadores                      = clientes_listado.idMarcadores
LEFT JOIN `marcadores_remarcadores`             ON marcadores_remarcadores.idRemarcadores               = clientes_listado.idRemarcadores
LEFT JOIN `clientes_estadopago`                 ON clientes_estadopago.idEstadoPago                     = clientes_listado.idEstadoPago
LEFT JOIN `clientes_facturable`                 ON clientes_facturable.idFacturable                     = clientes_listado.idFacturable
LEFT JOIN `mnt_ubicacion_ciudad`   ciudad       ON ciudad.idCiudad                                      = clientes_listado.idCiudadFact
LEFT JOIN `mnt_ubicacion_comunas`  comuna       ON comuna.idComuna                                      = clientes_listado.idComunaFact
LEFT JOIN `analisis_aguas_tipo_punto_muestreo`  ON analisis_aguas_tipo_punto_muestreo.idPuntoMuestreo   = clientes_listado.idPuntoMuestreo
LEFT JOIN `analisis_sectores`                   ON analisis_sectores.idSector                           = clientes_listado.idSector

WHERE clientes_listado.idCliente = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);


?>
<div class="col-lg-12">
	<h5 class="fleft"><?php echo '<strong>Cliente : </strong>'.$rowdata['Nombre']; ?></h5>
</div>
<div class="clearfix"></div>  

<div class="col-lg-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'clientes_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos_contacto.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Contacto</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_datos_facturacion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Facturacion</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
				<li class=""><a href="<?php echo 'clientes_listado_medicion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Mediciones</a></li>
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">
					<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
						<thead>
							<tr role="row">
								<th width="50%" class="word_break">Datos</th>
								<th width="50%">Mapa</th>
							</tr>
						</thead>					  
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<tr class="odd">
								<td class="word_break">
									<h2 class="text-primary">Datos Basicos</h2>
									<p class="text-muted">
										<strong>Tipo de Cliente : </strong><?php echo $rowdata['tipoCliente']; ?><br/>
										<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
										<strong>Rut : </strong><?php echo $rowdata['Rut']; ?><br/>
										<strong>Fecha de Ingreso Sistema : </strong><?php echo Fecha_completa($rowdata['fNacimiento']); ?><br/>
										<strong>Region : </strong><?php echo $rowdata['nombre_region']; ?><br/>
										<strong>Comuna : </strong><?php echo $rowdata['nombre_comuna']; ?><br/>
										<strong>Direccion : </strong><?php echo $rowdata['Direccion']; ?><br/>
										<strong>Sistema Relacionado : </strong><?php echo $rowdata['sistema']; ?>
									</p>
										
									<h2 class="text-primary">Datos de Contacto</h2>
									<p class="text-muted">
										<strong>Persona de Contacto : </strong><?php echo $rowdata['PersonaContacto']; ?><br/>
										<strong>Telefono 1 : </strong><?php echo $rowdata['Fono1']; ?><br/>
										<strong>Telefono 2 : </strong><?php echo $rowdata['Fono2']; ?><br/>
										<strong>Fax : </strong><?php echo $rowdata['Fax']; ?><br/>
										<strong>Email : </strong><a href="mailto:<?php echo $rowdata['email']; ?>"><?php echo $rowdata['email']; ?></a><br/>
										<strong>Web : </strong><a target="_new" href="http://<?php echo $rowdata['Web']; ?>"><?php echo $rowdata['Web']; ?></a>
									</p>
									
									<h2 class="text-primary">Datos de Facturacion</h2>
									<p class="text-muted">
										<strong>Identificador : </strong><?php echo $rowdata['Identificador']; ?><br/>
										<strong>ID medidor : </strong><?php echo $rowdata['medidor']; ?><br/>
										<strong>ID remarcador : </strong><?php echo $rowdata['remarcador']; ?><br/>
										<strong>Unidades Habitacionales : </strong><?php echo $rowdata['UnidadHabitacional']; ?><br/>
										<strong>Arranque : </strong><?php echo $rowdata['Arranque']; ?> mm<br/>
										<strong>Estado : </strong><?php echo $rowdata['EstadoPago']; ?><br/>
										<strong>Forma Facturacion : </strong><?php echo $rowdata['DocFacturable']; ?><br/>
										<strong>Region Facturacion : </strong><?php echo $rowdata['nombre_region_fact']; ?><br/>
										<strong>Ciudad Facturacion : </strong><?php echo $rowdata['nombre_comuna_fact']; ?><br/>
										<strong>Direccion Facturacion : </strong><?php echo $rowdata['DireccionFact']; ?><br/>
										<strong>Giro de la empresa: </strong><?php echo $rowdata['Giro']; ?><br/>
										<strong>Razon Social de la empresa: </strong><?php echo $rowdata['RazonSocial']; ?><br/>
											
									</p>
									
									<h2 class="text-primary">Datos de Medicion</h2>
									<p class="text-muted">
										<strong>Sector : </strong><?php echo $rowdata['Sector']; ?><br/>
										<strong>Tipo de Medicion : </strong><?php echo $rowdata['TipoPunto']; ?><br/>
									</p>	
									
								</td>
								<td>
									<?php echo mapa1($rowdata["latitud"], $rowdata["longitud"], $rowdata['Identificador']) ?>
								</td>
							</tr>                  
						</tbody>
					</table>
				</div>
			</div>
        </div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">	
		<header>		
			<div class="icons"><i class="fa fa-edit"></i></div>		
			<h5>Crear Nuevo Cliente</h5>	
		</header>	
		<div id="div-1" class="body">	
			<form class="form-horizontal" method="post" name="form1">
				
				<?php 
				//Se verifican si existen los datos
				if(isset($idTipo)) {           $x1  = $idTipo;            }else{$x1  = '';}
				if(isset($Nombre)) {           $x2  = $Nombre;            }else{$x2  = '';}
				if(isset($Rut)) {              $x3  = $Rut;               }else{$x3  = '';}
				if(isset($fNacimiento)) {      $x4  = $fNacimiento;       }else{$x4  = '';}
				if(isset($idCiudad)) {         $x5  = $idCiudad;          }else{$x5  = '';}
				if(isset($idComuna)) {         $x6  = $idComuna;          }else{$x6  = '';}
				if(isset($Direccion)) {        $x7  = $Direccion;         }else{$x7  = '';}
				if(isset($idSistema)) {        $x8  = $idSistema;         }else{$x8  = '';}
				if(isset($Giro)) {             $x9  = $Giro;              }else{$x9  = '';}


				//se dibujan los inputs
				echo '<h3>Datos Basicos</h3>';
				echo form_select('Tipo de Cliente','idTipo', $x1, 2, 'idTipo', 'Nombre', 'clientes_tipos', 0, $dbConn);
				echo form_input('text', 'Nombres', 'Nombre', $x2, 2);
				echo form_input_icon('text', 'Rut', 'Rut', $x3, 1,'fa fa-exclamation-triangle');
				echo form_date('F Ingreso Sistema','fNacimiento', $x4, 1);
				echo form_select_depend1('Ciudad','idCiudad', $x5, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
										'Comuna','idComuna', $x6, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
										 $dbConn, 'form1');
				echo form_input_icon('text', 'Direccion', 'Direccion', $x7, 2,'fa fa-map');	 
				if($arrUsuario['tipo']=='SuperAdmin'){
					echo form_select('Sistema','idSistema', $x8, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
				}else{
					echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
				}
				echo form_input('text', 'Giro de la empresa', 'Giro', $x9, 1);
				
				
				

				echo '<input type="hidden" name="idEstado"   value="1" >';
				echo '<input type="hidden" name="idEstadoPago"   value="1" >';		 
				?>
								
				<div class="form-group">		
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit">	
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>		
				</div>
			</form> 
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
} else  { 
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
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
//verifico que sea un administrador
if($arrUsuario['tipo']=='SuperAdmin'){
	$z="WHERE clientes_listado.idSistema>=0";	
}else{
	$z="WHERE clientes_listado.idSistema={$arrUsuario['idSistema']}";	
}
//Verifico si la variable de busqueda existe
if(isset($_GET['search']) && $_GET['search'] != ''){                         $z .= " AND clientes_listado.Identificador LIKE '%{$_GET['search']}%'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {                       $z .= " AND clientes_listado.Nombre LIKE '%{$_GET['Nombre']}%' " ;}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != '')  {                   $z .= " AND clientes_listado.idEstado = '".$_GET['idEstado']."'" ;}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != '')  {                   $z .= " AND clientes_listado.idCiudad = '".$_GET['idCiudad']."'" ;}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != '')  {                   $z .= " AND clientes_listado.idComuna = '".$_GET['idComuna']."'" ;}
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b'] != ''){ 
	$z .= " AND clientes_listado.fNacimiento BETWEEN '{$_GET['rango_a']}' AND '{$_GET['rango_b']}'" ;
}

//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT clientes_listado.idCliente FROM `clientes_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
clientes_listado.idCliente,
clientes_listado.Identificador,
clientes_facturable.Nombre AS DocFacturable,
clientes_estado.Nombre AS estado,
clientes_tipos.Nombre AS Tipo

FROM `clientes_listado`
LEFT JOIN `clientes_estado`      ON clientes_estado.idEstado          = clientes_listado.idEstado
LEFT JOIN `core_sistemas`        ON core_sistemas.idSistema           = clientes_listado.idSistema
LEFT JOIN `clientes_facturable`  ON clientes_facturable.idFacturable  = clientes_listado.idFacturable
LEFT JOIN `clientes_tipos`      ON clientes_tipos.idTipo          = clientes_listado.idTipo
".$z."
ORDER BY clientes_listado.Identificador ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUsers,$row );
}

?>
<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Cliente</label>
    <div class="col-lg-5">	
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >		
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Identificador">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onclick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nuevo Cliente</a><?php }?>
</div>
<div class="clearfix"></div>                     
                                 
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Clientes</h5>	
			<div class="toolbar">
				<?php 
				if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
				echo paginador_2('pagsup',$total_paginas, $original, $search, $num_pag ) ?>
			</div>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Identificador</th>
						<th width="120">Tipo</th>
						<th width="120">Forma Facturacion</th>
						<th width="120">Estado</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><?php echo $usuarios['Identificador']; ?></td>	
						<td><?php echo $usuarios['Tipo']; ?></td>		
						<td><?php echo $usuarios['DocFacturable']; ?></td>		
						<td><?php echo $usuarios['estado']; ?></td>		
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_cliente.php?view='.$usuarios['idCliente']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$usuarios['idCliente']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$usuarios['idCliente'];
									$dialogo   = '¿Realmente deseas eliminar al cliente '.$usuarios['Identificador'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
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
			if (isset($_GET['search'])) {  $search ='&search='.$_GET['search']; } else { $search='';}
			echo paginador_2('paginf',$total_paginas, $original, $search, $num_pag ) ?>
		</div>   
	</div>
</div>
	
	
<?php } ?>

<!-- InstanceEndEditable -->   
            </div>
        </div>
      </div> 
    </div>
    <?php require_once 'core/footer.php';?>
    <?php require_once 'assets/lib/avgrund/avgrund.php';?>
  </body>
</html>
