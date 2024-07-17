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
$original = "notificaciones_filtro.php";
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
if ( !empty($_POST['submit_filter']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idSistema';
	$form_trabajo= 'enviar_filtro';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_notificaciones.php';
}
//formulario para crear
if ( !empty($_POST['submit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idTrabajador,idUsuario,Titulo,Notificacion,Fecha';
	$form_trabajo= 'enviar_filtrados';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_notificaciones.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/z_notificaciones.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Notificacion Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Notificacion Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Notificacion borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['detalle']) ) { 
// Se traen todos los datos de mi usuario
$arrNotificaciones = array();
$query = "SELECT 
notificaciones_ver.Fecha,
notificaciones_ver.FechaVisto,
usuarios_listado.Nombre AS usuario,
notificaciones_estado.Nombre AS estado,
notificaciones_ver.idEstado,
notificaciones_listado.Titulo

FROM `notificaciones_ver`
LEFT JOIN `usuarios_listado`         ON usuarios_listado.idUsuario                = notificaciones_ver.idUsuario
LEFT JOIN `notificaciones_estado`    ON notificaciones_estado.idEstado            = notificaciones_ver.idEstado
LEFT JOIN `notificaciones_listado`   ON notificaciones_listado.idNotificaciones   = notificaciones_ver.idNotificaciones

WHERE notificaciones_ver.idNotificaciones = {$_GET['detalle']}";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrNotificaciones,$row );
}

?>
 
 


<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5><?php echo $arrNotificaciones[0]['Titulo'];?></h5>
		</header>
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped dataTable">
				<thead>
					<tr role="row">
						<th>Usuario</th>
						<th width="120">Estado</th>
						<th width="120">Fecha envio</th>
						<th width="120">Fecha leida</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrNotificaciones as $noti) { ?>
					<tr class="odd">
						<td><?php echo $noti['usuario']; ?></td>
						<td><?php echo $noti['estado']; ?></td>
						<td><?php echo fecha_estandar($noti['Fecha']); ?></td>
						<td><?php if($noti['idEstado']==2){echo fecha_estandar($noti['FechaVisto']);}?></td>
					</tr>
				<?php } ?>                    
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="col-lg-12 fcenter" style="margin-bottom:30px">
<a href="#" onclick="history.back()" class="btn btn-danger fright margin_width" data-original-title="" title="">Volver</a>
<div class="clearfix"></div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['filtro']) ) { 
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z='idSistema>=0  AND idEstado=1 AND tipo!="SuperAdmin"';	
}else{
	$z='idSistema='.$arrUsuario['idSistema'].' AND idEstado=1 AND tipo!="SuperAdmin"';	
}
	
//realizo el filtrado de acuerdo al filtro anterior
$w = 'WHERE idUsuario >0';
if(isset($_GET['tipo']) && $_GET['tipo'] != ''){                 $w .= " AND tipo = '{$_GET['tipo']}'";}
if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {           $w .= " AND Nombre LIKE '%{$_GET['Nombre']}%' " ;}
if(isset($_GET['Ciudad']) && $_GET['Ciudad'] != '')  {           $w .= " AND Ciudad LIKE '%{$_GET['Ciudad']}%'" ;}
if(isset($_GET['Comuna']) && $_GET['Comuna'] != '')  {           $w .= " AND Comuna LIKE '%{$_GET['Comuna']}%'" ;}
if(isset($_GET['Direccion']) && $_GET['Direccion'] != '')  {     $w .= " AND Direccion LIKE '%{$_GET['Direccion']}%'" ;}
if(isset($_GET['idSistema']) && $_GET['idSistema'] != '')  {     $w .= " AND idSistema = '".$_GET['idSistema']."'" ;}
if(isset($_GET['rango_a']) && $_GET['rango_a'] != ''&&isset($_GET['rango_b']) && $_GET['rango_b'] != ''){ 
	$w .= " AND fNacimiento BETWEEN '{$_GET['rango_a']}' AND '{$_GET['rango_b']}'" ;
}
$query = "SELECT COUNT(idUsuario) AS Cuenta
FROM `usuarios_listado`
".$w;
$resultado = mysqli_query ($dbConn, $query);
$row_count = mysqli_fetch_assoc ($resultado);

?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nueva Notificacion para <?php echo $row_count['Cuenta'] ?> usuarios</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($Titulo)) {        $x1  = $Titulo;        }else{$x1  = '';}
			if(isset($Notificacion)) {  $x2  = $Notificacion;  }else{$x2  = '';}

			//se dibujan los inputs
			echo form_input('text', 'Titulo', 'Titulo', $x1, 2);
			echo form_textarea('Notificacion','Notificacion', $x2, 2);
			echo '<input type="hidden" name="Fecha" value="'.fecha_actual().'" >';
			echo '<input type="hidden" name="idUsuario" value="'.$arrUsuario['idUsuario'].'" >';
			
			if(isset($_GET['tipo']) && $_GET['tipo'] != ''){              echo '<input type="hidden" name="tipo" value="'.$_GET['tipo'].'" >';}     
			if(isset($_GET['Nombre']) && $_GET['Nombre'] != '')  {        echo '<input type="hidden" name="Nombre" value="'.$_GET['Nombre'].'" >';}           
			if(isset($_GET['Ciudad']) && $_GET['Ciudad'] != '')  {        echo '<input type="hidden" name="Ciudad" value="'.$_GET['Ciudad'].'" >';}            
			if(isset($_GET['Comuna']) && $_GET['Comuna'] != '')  {        echo '<input type="hidden" name="Comuna" value="'.$_GET['Comuna'].'" >';}           
			if(isset($_GET['Direccion']) && $_GET['Direccion'] != '')  {  echo '<input type="hidden" name="Direccion" value="'.$_GET['Direccion'].'" >';}     
			if(isset($_GET['idSistema']) && $_GET['idSistema'] != '')  {  echo '<input type="hidden" name="idSistema" value="'.$_GET['idSistema'].'" >';}     
			if(isset($_GET['rango_a']) && $_GET['rango_a'] != '')  {      echo '<input type="hidden" name="rango_a" value="'.$_GET['rango_a'].'" >';}     
			if(isset($_GET['rango_b']) && $_GET['rango_b'] != '')  {      echo '<input type="hidden" name="rango_b" value="'.$_GET['rango_b'].'" >';}     
			?>
			
			<div class="form-group">
				<?php if($row_count['Cuenta']){?>
					<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Enviar" name="submit">
				<?php } ?>
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { 

?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Filtro para Busqueda Avanzada</h5>
		</header>
		<div id="div-1" class="body">
		<form name="form1" class="form-horizontal" method="post" >
			
            <?php 
			//Se verifican si existen los datos
			if(isset($tipo)) {          $x1  = $tipo;           }else{$x1  = '';}
			if(isset($Nombre)) {        $x2  = $Nombre;         }else{$x2  = '';}
			if(isset($rango_a)) {       $x3  = $rango_a;        }else{$x3  = '';}
            if(isset($rango_b)) {       $x4  = $rango_b;        }else{$x4  = '';}
			if(isset($Ciudad)) {        $x5  = $Ciudad;         }else{$x5  = '';}
			if(isset($Comuna)) {        $x6  = $Comuna;         }else{$x6  = '';}
			if(isset($Direccion)) {     $x7  = $Direccion;      }else{$x7  = '';}
			if(isset($idSistema)) {     $x8  = $idSistema;      }else{$x8  = '';}
			
			//se dibujan los inputs
			echo form_select('Tipo de Usuario','tipo', $x5, 1, 'Nombre', 'Nombre', 'usuarios_tipos', 0, $dbConn);
			echo form_input('text', 'Nombres', 'Nombre', $x1, 1);
			echo form_date('F Nacimiento inicio','rango_a', $x2, 1);
			echo form_date('F Nacimiento termino','rango_b', $x3, 1);
			echo form_input_icon('text', 'Ciudad', 'Ciudad', $x7, 1,'fa fa-map');
			echo form_input_icon('text', 'Comuna', 'Comuna', $x7, 1,'fa fa-map');
			echo form_input_icon('text', 'Direccion', 'Direccion', $x7, 1,'fa fa-map');
			if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select('Sistema','idSistema', $x8, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			?>        
   
			<div class="form-group">
				<input type="hidden" name="pagina" value="1" >
				<input type="submit" class="btn btn-primary fright margin_width" value="Buscar" name="submit_filter">
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
if(isset($_GET["pagina"])){
	$num_pag = $_GET["pagina"];	
} else {
	$num_pag = 1;	
}
//Defino la cantidad total de elementos por pagina
$cant_reg = 30;
//resto de variables
if (!$num_pag){
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
//Variable con la ubicacion
$z="WHERE notificaciones_listado.idNotificaciones!=0";
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND notificaciones_listado.Titulo LIKE '%{$_GET['search']}%'";	
}
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND notificaciones_listado.idSistema>=0";	
}else{
	$z.=" AND notificaciones_listado.idSistema={$arrUsuario['idSistema']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idNotificaciones FROM `notificaciones_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrNotificaciones = array();
$query = "SELECT idNotificaciones,Titulo, Fecha
FROM `notificaciones_listado`
".$z."
ORDER BY Fecha DESC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrNotificaciones,$row );
}?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Categoria</label>
    <div class="col-lg-5">
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Nombre">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onClick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nueva Notificacion</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Notificaciones</h5>
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
						<th>Fecha</th>
						<th>Titulo</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrNotificaciones as $noti) { ?>
					<tr class="odd">
						<td><?php echo fecha_estandar($noti['Fecha']); ?></td>
						<td><?php echo $noti['Titulo']; ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_notificacion.php?view='.$noti['idNotificaciones']; ?>" data-placement="bottom" title="Ver Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&detalle='.$noti['idNotificaciones']; ?>" data-placement="bottom" title="Ver detalle leidos" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$noti['idNotificaciones'];
									$dialogo   = '¿Realmente deseas eliminar la notificacion '.$noti['Titulo'].'?';?>
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
