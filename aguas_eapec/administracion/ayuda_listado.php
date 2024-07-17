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
$original = "ayuda_listado.php";
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
	$form_obligatorios = 'idSistema,id_pmcat,idAdmpm,Nombre,Version';
	$form_trabajo= 'insert';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/ayuda_listado.php';
}
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Llamamos al formulario
	$form_obligatorios = 'idAyuda,idSistema,id_pmcat,idAdmpm,Nombre,Version';
	$form_trabajo= 'update';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/ayuda_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/ayuda_listado.php';	
}
//se borra un dato
if ( !empty($_GET['del_file']) )     {
	//Llamamos al formulario
	$form_obligatorios = '';
	$form_trabajo= 'del_file';
	require_once '../AA2D2CFFDJFDJX1/xrxs_form/ayuda_listado.php';	
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Ayuda Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Ayuda Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Ayuda borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT idSistema, id_pmcat, idAdmpm, Nombre, Version, Direccion_img
FROM `ayuda_listado`
WHERE idAyuda = {$_GET['id']}";
$resultado = mysqli_query ($dbConn, $query);
$rowdata = mysqli_fetch_assoc ($resultado);	?>
 
<div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Modificacion del Archivo de ayuda</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" name="form1">

			<?php 
			//Se verifican si existen los datos
			if(isset($idSistema)) {   $x1  = $idSistema;  }else{$x1  = $rowdata['idSistema'];}
			if(isset($id_pmcat)) {    $x2  = $id_pmcat;   }else{$x2  = $rowdata['id_pmcat'];}
			if(isset($idAdmpm)) {     $x3  = $idAdmpm;    }else{$x3  = $rowdata['idAdmpm'];}
			if(isset($Nombre)) {      $x4  = $Nombre;     }else{$x4  = $rowdata['Nombre'];}
			if(isset($Version)) {     $x5  = $Version;    }else{$x5  = $rowdata['Version'];}

			//se dibujan los inputs
			if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select_sys('Sistema','idSistema', $x1, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			
			echo form_select_depend1('Categoria','id_pmcat', $x2, 2, 'id_pmcat', 'Nombre', 'core_permisos_cat', 0,
									'Permiso','idAdmpm', $x3, 2, 'idAdmpm', 'id_pmcat', 'Nombre', 'core_permisos', 0, 
									 $dbConn, 'form1');
									 
			echo form_input('text', 'Nombre', 'Nombre', $x4, 2);
			echo form_input_number('Version del Archivo', 'Version', $x5, 2);
			
			//si la imagen existe la muestro con las opciones de borrarla
			if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){?>
        
			<div class="col-lg-10 fcenter">
				<h3>Nombre Archivo</h3>
				<p><?php echo $rowdata['Direccion_img']; ?></p>
			</div>
            <a href="<?php echo $location.'&id='.$_GET['id'].'&del_file='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Borrar Archivo</a>
            <div class="clearfix" style="margin-bottom:10px;"></div>
        
			<?php }else{          
			//se dibujan los inputs
			echo form_input_file('Seleccionar archivo','imgLogo');
			}?> 
           
           
         

			<div class="form-group">
            	<input type="hidden" name="idAyuda" value="<?php echo $_GET['id']; ?>" >
				<input type="submit" id="text2"  class="btn btn-primary fright margin_width" value="Guardar Cambios" name="submit_edit"> 
				<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width" data-original-title="" title="">Cancelar y Volver</a>
			</div>
                      
			</form> 
                    
		</div>
	</div>
</div>

<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 } elseif ( ! empty($_GET['new']) ) { ?>
 <div class="col-lg-6 fcenter">
	<div class="box dark">
		<header>
			<div class="icons"><i class="fa fa-edit"></i></div>
			<h5>Crear Nuevo Archivo de ayuda</h5>
		</header>
		<div id="div-1" class="body">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" name="form1">
        	
			<?php 
			//Se verifican si existen los datos
			if(isset($idSistema)) {   $x1  = $idSistema;  }else{$x1  = '';}
			if(isset($id_pmcat)) {    $x2  = $id_pmcat;   }else{$x2  = '';}
			if(isset($idAdmpm)) {     $x3  = $idAdmpm;    }else{$x3  = '';}
			if(isset($Nombre)) {      $x4  = $Nombre;     }else{$x4  = '';}
			if(isset($Version)) {     $x5  = $Version;    }else{$x5  = '';}

			//se dibujan los inputs
			if($arrUsuario['tipo']=='SuperAdmin'){
				echo form_select_sys('Sistema','idSistema', $x1, 2, 'idSistema', 'Nombre', 'core_sistemas', 0, $dbConn);
			}else{
				echo '<input type="hidden" name="idSistema"   value="'.$arrUsuario['idSistema'].'">';
			}
			
			echo form_select_depend1('Categoria','id_pmcat', $x2, 2, 'id_pmcat', 'Nombre', 'core_permisos_cat', 0,
									'Permiso','idAdmpm', $x3, 2, 'idAdmpm', 'id_pmcat', 'Nombre', 'core_permisos', 0, 
									 $dbConn, 'form1');
									 
			echo form_input('text', 'Nombre', 'Nombre', $x4, 2);
			echo form_input_number('Version del Archivo', 'Version', $x5, 2);
			echo form_input_file('Seleccionar archivo','imgLogo');
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
$z="WHERE ayuda_listado.idAyuda!=0";
//Verifico si la variable de busqueda existe
if (isset($_GET['search'])){
	$z.=" AND ayuda_listado.Nombre LIKE '%{$_GET['search']}%'";	
}
//Verifico el tipo de usuario que esta ingresando
if($arrUsuario['tipo']=='SuperAdmin'){
	$z.=" AND ayuda_listado.idSistema>=0";	
}else{
	$z.=" AND ayuda_listado.idSistema={$arrUsuario['idSistema']}";	
}
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT idAyuda FROM `ayuda_listado` ".$z."";
$registros = mysqli_query ($dbConn, $query);
$cuenta_registros = mysqli_num_rows($registros);
//Realizo la operacion para saber la cantidad de paginas que hay
$total_paginas = ceil($cuenta_registros / $cant_reg);	
// Se trae un listado con todos los usuarios
$arrTipo = array();
$query = "SELECT 
ayuda_listado.idAyuda,
core_sistemas.Nombre AS RazonSocial,
core_permisos.Nombre AS NombrePermiso,
core_permisos.Version AS VersionPermiso,	
core_permisos_cat.Nombre AS NombreCategoria,
ayuda_listado.Nombre AS NombreAyuda,
ayuda_listado.Version AS Version,
ayuda_listado.Direccion_img


FROM `ayuda_listado`
LEFT JOIN `core_sistemas`       ON core_sistemas.idSistema      = ayuda_listado.idSistema
LEFT JOIN `core_permisos`       ON core_permisos.idAdmpm        = ayuda_listado.idAdmpm
LEFT JOIN `core_permisos_cat`   ON core_permisos_cat.id_pmcat   = ayuda_listado.id_pmcat
".$z."
ORDER BY core_permisos_cat.Nombre ASC, core_permisos.Nombre ASC, ayuda_listado.Nombre ASC
LIMIT $comienzo, $cant_reg ";
$resultado = mysqli_query ($dbConn, $query);
while ( $row = mysqli_fetch_assoc ($resultado)) {
array_push( $arrTipo,$row );
}?>

<div class="form-group">
<form class="form-horizontal" action="<?php echo $location ?>"  name="form1">
<label class="control-label col-lg-4">Buscar Archivo</label>
    <div class="col-lg-5">
		<div class="input-group bootstrap-timepicker fmrnew">
        	<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<input class="form-control timepicker-default" type="text" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];}?>" placeholder="Nombre">
            <button type="submit" class="t_search_button"><i class="fa fa-search"></i></button>
            <button class="t_search_button2" onClick="document.form1.search.value = '';"><i class="fa fa-trash-o"></i></button>
		</div>
    </div>
</form>
<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" >Crear Nueva Ayuda</a><?php } ?>
</div>
<div class="clearfix"></div>                       
                                 
<div class="col-lg-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Archivos de ayuda</h5>
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
						<th>Sistema</th>
						<th>Categoria - Transaccion</th>
						<th>Nombre</th>
						<th>Version</th>
						<th width="120">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($arrTipo as $tipo) { ?>
					<tr class="odd">
						<td><?php if(isset($tipo['RazonSocial'])&&$tipo['RazonSocial']!=''){echo $tipo['RazonSocial'];}else{echo 'Todos';} ?></td>
						<td><?php echo $tipo['NombreCategoria'].' : '.$tipo['NombrePermiso']; ?></td>
						<td><?php echo $tipo['NombreAyuda']; ?></td>
						<td><?php if($tipo['Version']==$tipo['VersionPermiso']){ echo $tipo['Version']; }else{ echo 'Revisar'; } ?></td>
						<td>
							<div class="btn-group widthtd120" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'upload/'.$tipo['Direccion_img']; ?>" data-placement="bottom" title="Descargar Archivo" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-download"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$tipo['idAyuda']; ?>" data-placement="bottom" title="Editar Informacion" data-toggle="tooltip" class="btn btn-primary btn-sm info-tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$tipo['idAyuda'];
									$dialogo   = '¿Realmente deseas eliminar el archivo de ayuda '.$tipo['NombreAyuda'].'?';?>
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
