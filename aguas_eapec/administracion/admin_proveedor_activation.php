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
require_once '../AA2D2CFFDJFDJX1/PHPMailer/class.phpmailer.php';
require_once '../AA2D2CFFDJFDJX1/xrxs_funciones/componentes.php';
/**********************************************************************************************************************************/
/*                                          Modulo de identificacion del documento                                                */
/**********************************************************************************************************************************/
//Cargamos la ubicacion 
$original = "admin_proveedor_activation.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
if(isset($_GET['search']) && $_GET['search'] != ''){                       $location .= "&search=".$_GET['search'] ; 	}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                       $location .= "&Nombre=".$_GET['Nombre'] ; }
if(isset($_GET['Estado']) && $_GET['Estado'] != ''){                       $location .= "&Estado=".$_GET['Estado'] ; }
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != ''){                   $location .= "&idCiudad=".$_GET['idCiudad'] ; }
if(isset($_GET['idComuna']) && $_GET['idComuna'] != ''){                   $location .= "&idComuna=".$_GET['idComuna'] ; }
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b'] != ''){ 
	$location .= "&rango_a={$_GET['rango_a']}&rango_b={$_GET['rango_b']}" ; 
}
//Verifico los permisos del usuario sobre la transaccion
require_once '../AA2D2CFFDJFDJX1/xrxs_configuracion/permisos.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//Si el estado esta distinto de vacio
if ( !empty($_GET['estado']) ) {
	//Llamamos al formulario
	$location.='#'.$_GET['anclaje'];
	$form_obligatorios = '';
	$form_trabajo= 'estado';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_listado.php';
}
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$location.='&view_obs='.$_GET['view_obs'];
	$form_obligatorios = 'idProveedor,idUsuario,Fecha,Observacion';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_observaciones.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$location.='&view_obs='.$_GET['view_obs'];
	$form_obligatorios = 'idObservacion,Observacion';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_observaciones.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$location.='&view_obs='.$_GET['view_obs'];
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/proveedor_observaciones.php';	
}
//formulario para envio de mensaje
if ( !empty($_POST['mms']) )  {
	//Llamamos al formulario
	$form_obligatorios = 'Titulo,Mensaje,idProveedor';
	$form_trabajo= 'envio1';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_envio_msg.php';	
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
if (isset($_GET['created']))  {$error['usuario'] 	  = 'sucess/Observacion creada correctamente';}
if (isset($_GET['edited']))   {$error['usuario'] 	  = 'sucess/Observacion editada correctamente';}
if (isset($_GET['deleted']))  {$error['usuario'] 	  = 'sucess/Observacion borrada correctamente';}
if (isset($_GET['mms_send'])) {$error['usuario'] 	  = 'sucess/Mensaje enviado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['send_obs']) ) {
// tomo los datos del usuario
$query = "SELECT Nombre
FROM `proveedor_listado`
WHERE idProveedor = {$_GET['send_obs']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); ?>
<div class="col-lg-8 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Enviar mensaje a <?php echo $rowdata['Nombre']; ?></h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
            <?php 
			//Se verifican si existen los datos
			if(isset($Titulo)) {        $x1  = $Titulo;       }else{$x1  = '';}
			if(isset($Mensaje)) {       $x2  = $Mensaje;      }else{$x2  = '';}

			//se dibujan los inputs
			echo form_input('text', 'Titulo del mensaje', 'Titulo', $x1, 2);
			echo form_ckeditor('Mensaje','Mensaje', $x2, 2, 1);
			?>
          
			<div class="form-group">
				<input type="hidden"  name="idProveedor"   value="<?php echo $_GET['send_obs'] ?>">
				<input type="submit" class="btn btn-primary fright margin_width" value="Enviar" name="mms"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>



<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['id']) ) { 
//Se trae la observacion
$query = "SELECT Observacion
FROM `proveedor_observaciones`
WHERE idObservacion = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); 	?>
 
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Editar Observacion</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" name="form1">
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = $rowdata['Observacion'];}

				//se dibujan los inputs
				echo form_textarea('Observaciones', 'Observacion', $x1, 2);
				?>
			  
				<div class="form-group">
					<input type="hidden" name="idObservacion" value="<?php echo $_GET['id']; ?>" >
					<input type="submit" class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
				</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['new']) ) { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nueva Observacion</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
            <?php 
			//Se verifican si existen los datos
			if(isset($Observacion)) {     $x1  = $Observacion;    }else{$x1  = '';}

			//se dibujan los inputs
			echo form_textarea('Observaciones', 'Observacion', $x1, 2);
			?>
          
			<div class="form-group">
            	<input type="hidden" name="idProveedor" value="<?php echo $_GET['view_obs'] ?>">
                <input type="hidden" name="idUsuario" value="<?php echo $arrUsuario['idUsuario'] ?>">
                <input type="hidden" name="Fecha" value="<?php echo fecha_actual() ?>">	
				<input type="submit" class="btn btn-primary fright margin_width" value="Guardar" name="submit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view']) ) { 
//Obtengo los datos de una observacion
$query = "SELECT 
proveedor_listado.Nombre AS nombre_cliente,
usuarios_listado.Nombre AS nombre_usuario,
proveedor_observaciones.Fecha,
proveedor_observaciones.Observacion
FROM `proveedor_observaciones`
LEFT JOIN `proveedor_listado`  ON proveedor_listado.idProveedor    = proveedor_observaciones.idProveedor
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = proveedor_observaciones.idUsuario
WHERE proveedor_observaciones.idObservacion = {$_GET['view']}
ORDER BY proveedor_observaciones.idObservacion ASC ";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);
?>
<div class="col-lg-8">
	<div class="box">	
		<header>		
			<h5>Ver Datos de la Observacion</h5>		
			<div class="toolbar"></div>	
		</header>
        <div class="body">
            <h2 class="text-primary">Datos Basicos</h2>
            <p class="text-muted"><strong>Proveedor : </strong><?php echo $rowdata['nombre_cliente']; ?></p>
            <p class="text-muted"><strong>Usuario : </strong><?php echo $rowdata['nombre_usuario']; ?></p>
            <p class="text-muted"><strong>Fecha : </strong><?php echo Fecha_completa_alt($rowdata['Fecha']); ?></p>
                      
            <h2 class="text-primary">Observacion</h2>
            <p class="text-muted word_break " ><strong>Observacion : </strong><?php echo $rowdata['Observacion']; ?></p>
            	
        </div></div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<?php 
//Se verifican las variables
$location .='&view_obs='.$_GET['view_obs'];
?>
<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>
 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
}elseif ( ! empty($_GET['view_obs']) ) {
// tomo los datos del usuario
$query = "SELECT Nombre
FROM `proveedor_listado`
WHERE idProveedor = {$_GET['view_obs']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado); 
// Se trae un listado con todas las observaciones el cliente
$arrObservaciones = array();
$query = "SELECT 
proveedor_observaciones.idObservacion,
proveedor_listado.Nombre AS nombre_cliente,
usuarios_listado.Nombre AS nombre_usuario,
proveedor_observaciones.Fecha,
proveedor_observaciones.Observacion
FROM `proveedor_observaciones`
LEFT JOIN `proveedor_listado`  ON proveedor_listado.idProveedor    = proveedor_observaciones.idProveedor
LEFT JOIN `usuarios_listado`   ON usuarios_listado.idUsuario     = proveedor_observaciones.idUsuario
WHERE proveedor_observaciones.idProveedor = {$_GET['view_obs']}
ORDER BY proveedor_observaciones.idObservacion ASC ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrObservaciones,$row );
}
//Se agregan ubicaciones
$x='&view_obs='.$_GET['view_obs'];
?> 

<div class="form-group">
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location.$x; ?>&new=true" class="btn btn-default fright margin_width" >Crear Nueva Observacion</a><?php }?>
</div>
<div class="clearfix"></div>                     
                                 
<div class="col-lg-12">
	<div class="box">	
		<header>
			<div class="icons"><i class="fa fa-table"></i></div>
			<h5>Observaciones de <?php echo $rowdata['Nombre']; ?></h5>	
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Autor</th>
						<th>Fecha</th>
						<th>Observacion</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrObservaciones as $observaciones) { ?>
					<tr class="odd">		
						<td><?php echo $observaciones['nombre_usuario']; ?></td>
						<td><?php echo $observaciones['Fecha']; ?></td>		
						<td><?php echo cortar($observaciones['Observacion'], 70); ?></td>		
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo $location.$x.'&view='.$observaciones['idObservacion']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.$x.'&id='.$observaciones['idObservacion']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.$x.'&del='.$observaciones['idObservacion'];
									$dialogo   = '¿Realmente deseas eliminar el registro de : '.$observaciones['nombre_usuario'].'?';?>
									<a onClick="dialogBox('<?php echo $ubicacion ?>', '<?php echo $dialogo ?>')" data-placement="bottom" title="Borrar Informacion" data-toggle="tooltip" class="btn btn-metis-1 btn-sm info-tooltip"><i class="fa fa-trash-o"></i></a>
								<?php } ?>								
							</div>
						</td>	
					</tr>
					<?php } ?>                    
				</tbody>
			</table> 
		</div>
	</div>
</div>


 
<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div> 
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['fullsearch']) ) { ?>
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro para Busqueda Avanzada</h5>
		</header>
		<div id="div-1" class="body">
		<form name="form1" class="form-horizontal" action="<?php echo $location; ?>" >
			
            <?php 
			//Se verifican si existen los datos
			if(isset($Nombre)) {                 $x1  = $Nombre;                 }else{$x1  = '';}
			if(isset($rango_a)) {                $x2  = $rango_a;                }else{$x2  = '';}
            if(isset($rango_b)) {                $x3  = $rango_b;                }else{$x3  = '';}
			if(isset($Estado)) {                 $x5  = $Estado;                 }else{$x5  = '';}
			if(isset($idCiudad)) {               $x6  = $idCiudad;               }else{$x6  = '';}
			if(isset($idComuna)) {               $x7  = $idComuna;               }else{$x7  = '';}
			
			//se dibujan los inputs
			echo form_input('text', 'Nombres', 'Nombre', $x1, 1);
			echo form_date('F Nacimiento inicio','rango_a', $x2, 1);
			echo form_date('F Nacimiento termino','rango_b', $x3, 1);
			echo form_select('Estado Proveedor','idEstado', $x5, 1, 'idEstado', 'Nombre', 'proveedor_estado', 0, $dbConn);
			echo form_select_depend1('Ciudad','idCiudad', $x6, 1, 'idCiudad', 'Nombre', 'mnt_ubicacion_ciudad', 0,
									'Comuna','idComuna', $x7, 1, 'idComuna', 'idCiudad', 'Nombre', 'mnt_ubicacion_comunas', 0, 
									 $dbConn, 'form1');
			?>        
   
			<div class="form-group">
            	<input type="hidden" name="pagina" value="1" >
				<input type="submit" class="btn btn-primary fright margin_width" value="Buscar" >
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div> 
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 }else{
//Se inicializa el paginador de resultados
//tomo el numero de la pagina si es que este existe
if(isset($_GET["pagina"])){$num_pag = $_GET["pagina"];	
} else {$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){$comienzo = 0 ;$num_pag = 1 ;
} else {$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//Le agrego condiciones a la consulta
$z="WHERE proveedor_listado.idSistema=1";	//Sistema sos
//Verifico si la variable de busqueda existe
if(isset($_GET['search']) && $_GET['search'] != ''){                         $z .= " AND proveedor_listado.Rut LIKE '%{$_GET['search']}%'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {                       $z .= " AND proveedor_listado.Nombre LIKE '%{$_GET['Nombre']}%' " ;}
if(isset($_GET['Estado']) && $_GET['Estado'] != '')  {                       $z .= " AND proveedor_listado.Estado = '".$_GET['Estado']."'" ;}
if(isset($_GET['idCiudad']) && $_GET['idCiudad'] != '')  {                   $z .= " AND proveedor_listado.idCiudad = '".$_GET['idCiudad']."'" ;}
if(isset($_GET['idComuna']) && $_GET['idComuna'] != '')  {                   $z .= " AND proveedor_listado.idComuna = '".$_GET['idComuna']."'" ;}
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b'] != ''){ 
	$z .= " AND proveedor_listado.fNacimiento BETWEEN '{$_GET['rango_a']}' AND '{$_GET['rango_b']}'" ;
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idProveedor FROM `proveedor_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrUsers = array();
$query = "SELECT 
proveedor_listado.idProveedor,
proveedor_listado.Rut,
proveedor_listado.Nombre,
proveedor_estado.Nombre AS estado,
core_sistemas.Nombre AS sistema
FROM `proveedor_listado`
LEFT JOIN `proveedor_estado`  ON proveedor_estado.idEstado      = proveedor_listado.idEstado
LEFT JOIN `core_sistemas`     ON core_sistemas.idSistema        = proveedor_listado.idSistema
".$z."
ORDER BY proveedor_listado.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrUsers,$row );
}
?>
<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Proveedor</label>
    <div class="col-lg-5">	
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >		
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Rut">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <a href="<?php echo $location; ?>&fullsearch=true" class="t_search_button_full" ><i class="fa fa-search-plus"></i></a>
            <button class="t_search_button2" onclick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>	
		</div>
    </div>
</form>
</div>
                      
                                 
<div class="col-lg-12">
	<div class="box">	
		<header>		
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Proveedores</h5>	
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
						<th>Rut</th>
						<th>Nombre del Proveedor</th>	
						<th>Sistema</th>
						<th>Estado</th>
						<th>Acciones</th>
						<th width="120">Observaciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrUsers as $usuarios) { ?>
					<tr class="odd">		
						<td><a name="<?php echo $usuarios['idProveedor'] ?>"></a> <?php echo $usuarios['Rut']; ?></td>		
						<td><?php echo $usuarios['Nombre']; ?></td>		
						<td><?php echo $usuarios['sistema']; ?></td>		
						<td><?php echo $usuarios['estado']; ?></td>		
						<td>
							<div style="width:90px;" >
								<?php 
								//Creacion de variable de anclaje
								$w='&anclaje='.$usuarios['idProveedor'];			?>  
								<?php if ($rowlevel['level']>=2){?>    				
									<ul class="interruptor">   
									   <?php if ( $usuarios['estado']=='Activo' ) {?>   
										<li class="primer_int"><a href="<?php echo $location.'&id='.$usuarios['idProveedor'].'&estado=2'.$w ; ?>">OFF</a></li>
										<li class="ultimo_int on"><a href="#">ON</a></li>
									   <?php } elseif ( $usuarios['estado']=='Inactivo' ) {?>
										<li class="primer_int on"><a href="#">OFF</a></li>
										<li class="ultimo_int"><a href="<?php echo $location.'&id='.$usuarios['idProveedor'].'&estado=1'.$w ; ?>">ON</a></li>
									   <?php }else{?>
										<li class="primer_int"><a href="#">OFF</a></li>
										<li class="ultimo_int"><a href="#">ON</a></li>
									   <?php }?>    
									</ul>
								<?php }?> 
							</div>            		
						</td>
						<td> 
							<div class="btn-group" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&view_obs='.$usuarios['idProveedor']; ?>" data-placement="bottom" title="Editar Observaciones" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&send_obs='.$usuarios['idProveedor']; ?>" data-placement="bottom" title="Enviar mensaje" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-paper-plane"></i></a><?php } ?>
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
