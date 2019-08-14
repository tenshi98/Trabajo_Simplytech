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
$original = "variedades_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                  $location .= "&Nombre=".$_GET['Nombre'];                   $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                  $location .= "&idTipo=".$_GET['idTipo'];                   $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $location .= "&idCategoria=".$_GET['idCategoria'];         $search .= "&idCategoria=".$_GET['idCategoria'];}
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
	require_once 'A1XRXS_sys/xrxs_form/variedades_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/variedades_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/Variedad Creada correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/Variedad Modificada correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/Variedad borrada correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
variedades_listado.Nombre,
variedades_listado.Descripcion,
variedades_listado.Codigo,
variedades_listado.Direccion_img,
variedades_listado.idTipoImagen,
sistema_variedades_categorias.Nombre AS Categoria,
sistema_variedades_tipo.Nombre AS Tipo,
variedades_listado.FichaTecnica,
variedades_listado.HDS,
core_estados.Nombre AS Estado

FROM `variedades_listado`
LEFT JOIN `sistema_variedades_tipo`          ON sistema_variedades_tipo.idTipo                   = variedades_listado.idTipo
LEFT JOIN `sistema_variedades_categorias`    ON sistema_variedades_categorias.idCategoria        = variedades_listado.idCategoria
LEFT JOIN `core_estados`                     ON core_estados.idEstado                            = variedades_listado.idEstado

WHERE variedades_listado.idProducto = {$_GET['id']}";
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
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-cog faa-spin animated " aria-hidden="true"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Variedades</span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Resumen</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="<?php echo 'variedades_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'variedades_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'variedades_listado_datos_descripcion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Descripcion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'variedades_listado_datos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class=""><a href="<?php echo 'variedades_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'variedades_listado_datos_ficha.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Ficha</a></li>
						<li class=""><a href="<?php echo 'variedades_listado_datos_hds.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >HDS</a></li>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/productos.jpg">
						<?php }else{
							//se selecciona el tipo de imagen
							switch ($rowdata['idTipoImagen']) {
								//Si no esta configurada
								case 0:
									echo '<img src="upload/'.$rowdata['Direccion_img'].'" style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture"  >';
									break;
								//Normal
								case 1:
									echo '<img src="upload/'.$rowdata['Direccion_img'].'" style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture"  >';
									break;
								//Tambor
								case 2:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/prefixfree/prefixfree.min.js"></script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/drum.js"></script>';
									echo '<script>
										var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";	
										document.getElementById("cover_prod").appendChild(createBarrel(textura));
									</script>';
									break;
								//Cubo
								case 2:
									
									break;
							}
							
						}?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de Variedad</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Codigo : </strong><?php echo $rowdata['Codigo']; ?><br/>
							<strong>Especie : </strong><?php echo $rowdata['Categoria']; ?><br/>
							<strong>Grupo Especie : </strong><?php echo $rowdata['Tipo']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?>
						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Descripcion</h2>
						<p class="text-muted"><?php echo $rowdata['Descripcion']; ?></p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Archivos</h2>
						<table id="items" style="margin-bottom: 20px;">
							<tbody>
								<?php 
								//Ficha Tecnica
								if(isset($rowdata['FichaTecnica'])&&$rowdata['FichaTecnica']!=''){
									echo '
										<tr class="item-row">
											<td>Ficha Tecnica</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['FichaTecnica'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['FichaTecnica'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								//Hoja de seguridad
								if(isset($rowdata['HDS'])&&$rowdata['HDS']!=''){
									echo '
										<tr class="item-row">
											<td>Hoja de seguridad</td>
											<td width="10">
												<div class="btn-group" style="width: 70px;">
													<a href="view_doc_preview.php?path=upload&file='.$rowdata['HDS'].'" title="Ver Documento" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-eye"></i></a>
													<a href="1download.php?dir=upload&file='.$rowdata['HDS'].'" title="Descargar Archivo" class="btn btn-primary btn-sm tooltip"><i class="fa fa-download"></i></a>
												</div>
											</td>
										</tr>
									';
								}
								?>
							</tbody>
						</table>
						<?php require_once '../LIBS_js/modal/modal.php';?>
						

						
					</div>	
					<div class="clearfix"></div>
			
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
			<h5>Crear Variedad</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($idTipo)) {         $x2  = $idTipo;           }else{$x2  = '';}
				if(isset($idCategoria)) {    $x3  = $idCategoria;      }else{$x3  = '';}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select_filter('Grupo Especie','idTipo', $x2, 2, 'idTipo', 'Nombre', 'sistema_variedades_tipo', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Especie','idCategoria', $x3, 2, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, '', $dbConn);
					
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('idOpciones_1', 2, 2);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf0c7; Guardar Cambios" name="submit">
					<a href="<?php echo $location; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Cancelar y Volver</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>        
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
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':      $order_by = 'ORDER BY variedades_listado.Nombre ASC ';               $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':     $order_by = 'ORDER BY variedades_listado.Nombre DESC ';              $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'categoria_asc':   $order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Especie Ascendente';break;
		case 'categoria_desc':  $order_by = 'ORDER BY sistema_variedades_categorias.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Especie Descendente';break;
		case 'tipo_asc':        $order_by = 'ORDER BY sistema_variedades_tipo.Nombre ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Grupo Especie Ascendente';break;
		case 'tipo_desc':       $order_by = 'ORDER BY sistema_variedades_tipo.Nombre DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Grupo Especie Descendente';break;
		case 'estado_asc':      $order_by = 'ORDER BY core_estados.Nombre ASC ';                    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':     $order_by = 'ORDER BY core_estados.Nombre DESC ';                   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC, variedades_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Especie, Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY sistema_variedades_categorias.Nombre ASC, variedades_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Especie, Nombre Ascendente';
}
/**********************************************************/
$z="WHERE variedades_listado.idProducto >= 1";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                  $z .= " AND variedades_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                  $z .= " AND variedades_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $z .= " AND variedades_listado.idCategoria=".$_GET['idCategoria'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT variedades_listado.idProducto FROM `variedades_listado` ".$z;
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
$arrProductos = array();
$query = "SELECT 
variedades_listado.idProducto,
variedades_listado.Nombre AS NombreProd,
sistema_variedades_tipo.Nombre AS Tipo,
sistema_variedades_categorias.Nombre AS Categoria,
core_estados.Nombre AS Estado,
variedades_listado.idEstado

FROM `variedades_listado`
LEFT JOIN `sistema_variedades_tipo`          ON sistema_variedades_tipo.idTipo                = variedades_listado.idTipo
LEFT JOIN `sistema_variedades_categorias`    ON sistema_variedades_categorias.idCategoria     = variedades_listado.idCategoria
LEFT JOIN `core_estados`                     ON core_estados.idEstado                         = variedades_listado.idEstado
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
array_push( $arrProductos,$row );
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
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Variedad</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($idTipo)) {         $x2  = $idTipo;           }else{$x2  = '';}
				if(isset($idCategoria)) {    $x3  = $idCategoria;      }else{$x3  = '';}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				$Form_Imputs->form_select_filter('Grupo Especie','idTipo', $x2, 1, 'idTipo', 'Nombre', 'sistema_variedades_tipo', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Especie','idCategoria', $x3, 1, 'idCategoria', 'Nombre', 'sistema_variedades_categorias', 0, '', $dbConn);
				
				$Form_Imputs->form_input_hidden('pagina', $_GET['pagina'], 1);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf002; Filtrar" name="filtro_form">
					<a href="<?php echo $original.'?pagina=1'; ?>" class="btn btn-danger fright margin_width"><i class="fa fa-trash-o" aria-hidden="true"></i> Limpiar</a>
				</div>
                      
			</form> 
            <?php require_once '../LIBS_js/validator/form_validator.php';?>
        </div>
	</div>
</div>
<div class="clearfix"></div> 
                      
                                 
<div class="col-sm-12">
	<div class="box">
		<header>
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Variedades</h5>
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
							<div class="pull-left">Especie</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=categoria_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=categoria_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Grupo Especie</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
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
						<th width="10">Acciones</th>
					</tr>
				</thead>			  
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $prod) { ?>
					<tr class="odd">
						<td><?php echo $prod['Categoria']; ?></td>
						<td><?php echo $prod['Tipo']; ?></td>
						<td><?php echo $prod['NombreProd']; ?></td>
						<td><label class="label <?php if(isset($prod['idEstado'])&&$prod['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $prod['Estado']; ?></label></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_variedades.php?view='.$prod['idProducto']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$prod['idProducto']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$prod['idProducto'];
									$dialogo   = '¿Realmente deseas eliminar la Variedad '.$prod['NombreProd'].'?';?>
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

<?php require_once '../LIBS_js/modal/modal.php';?>
<?php } ?>           
<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
