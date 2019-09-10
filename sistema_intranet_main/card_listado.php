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
$original = "card_listado.php";
$location = $original;
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                  $location .= "&Nombre=".$_GET['Nombre'];                   $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idCardImage']) && $_GET['idCardImage'] != ''){                  $location .= "&idCardImage=".$_GET['idCardImage'];                   $search .= "&idCardImage=".$_GET['idCardImage'];}
if(isset($_GET['idCardType']) && $_GET['idCardType'] != ''){        $location .= "&idCardType=".$_GET['idCardType'];         $search .= "&idCardType=".$_GET['idCardType'];}
if(isset($_GET['Marca']) && $_GET['Marca'] != ''){                    $location .= "&Marca=".$_GET['Marca'];                     $search .= "&Marca=".$_GET['Marca'];}
if(isset($_GET['idUml']) && $_GET['idUml'] != ''){                    $location .= "&idUml=".$_GET['idUml'];                     $search .= "&idUml=".$_GET['idUml'];}
if(isset($_GET['idCardImageProducto']) && $_GET['idCardImageProducto'] != ''){  $location .= "&idCardImageProducto=".$_GET['idCardImageProducto'];   $search .= "&idCardImageProducto=".$_GET['idCardImageProducto'];}
if(isset($_GET['idCardImageReceta']) && $_GET['idCardImageReceta'] != ''){      $location .= "&idCardImageReceta=".$_GET['idCardImageReceta'];       $search .= "&idCardImageReceta=".$_GET['idCardImageReceta'];}
if(isset($_GET['idSubTipo']) && $_GET['idSubTipo'] != ''){            $location .= "&idSubTipo=".$_GET['idSubTipo'];             $search .= "&idSubTipo=".$_GET['idSubTipo'];}
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
	require_once 'A1XRXS_sys/xrxs_form/card_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
	require_once 'A1XRXS_sys/xrxs_form/card_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
card_listado.Nombre AS CardNombre,
card_listado.Direccion_img,
core_sistemas_opciones.Nombre AS Imagen,
core_card_type.Nombre AS Tipo,
core_card_position.Nombre AS Posicion

FROM `card_listado`
LEFT JOIN `core_sistemas_opciones`  ON core_sistemas_opciones.idOpciones   = card_listado.idCardImage
LEFT JOIN `core_card_type`          ON core_card_type.idCardType           = card_listado.idCardType
LEFT JOIN `core_card_position`      ON core_card_position.idPosition       = card_listado.idPosition
WHERE card_listado.idCard = {$_GET['id']}";
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
				<span class="info-box-text">Tarjetas</span>
				<span class="info-box-number"><?php echo $rowdata['CardNombre']; ?></span>

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
				<li class="active"><a href="<?php echo 'card_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'card_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'card_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>          
			</ul>	
		</header>
        <div id="div-3" class="tab-content">
			
			<div class="tab-pane fade active in" id="basicos">
				<div class="wmd-panel">

					<div class="col-sm-4">
						<?php if ($rowdata['Direccion_img']=='') { ?>
							<img style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture" src="<?php echo DB_SITE ?>/LIB_assets/img/card.jpg">
						<?php }else{
							echo '<img src="upload/'.$rowdata['Direccion_img'].'" style="margin-top:10px;" class="media-object img-thumbnail user-img width100" alt="User Picture"  >';
						}?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de la tarjeta</h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['CardNombre']; ?><br/>
							<strong>Tipo Tarjeta : </strong><?php echo $rowdata['Tipo']; ?><br/>
							<strong>Posicion Texto : </strong><?php echo $rowdata['Posicion']; ?><br/>
							<strong>Uso Avatar : </strong><?php echo $rowdata['Imagen']; ?>
						</p>
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
			<h5>Crear Tarjeta</h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {       $x1  = $Nombre;       }else{$x1  = '';}
				if(isset($idCardType)) {   $x2  = $idCardType;   }else{$x2  = '';}
				if(isset($idPosition)) {   $x3  = $idPosition;   }else{$x3  = '';}
				if(isset($idCardImage)) {  $x4  = $idCardImage;  }else{$x4  = '';}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select_depend1('Tipo Tarjeta','idCardType', $x2, 2, 'idCardType', 'Nombre', 'core_card_type', 0, 0,
										 'Posicion Texto','idPosition', $x3, 2, 'idPosition', 'Nombre', 'core_card_position', 0, 0, 
										 $dbConn, 'form1');	
				$Form_Imputs->form_select('Uso Avatar','idCardImage', $x4, 2, 'idOpciones', 'Nombre', 'core_sistemas_opciones', 0, '', $dbConn);
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
	$comienzo = 0 ;
	$num_pag = 1 ;
} else {
	$comienzo = ( $num_pag - 1 ) * $cant_reg ;
}
/**********************************************************/
//ordenamiento
if(isset($_GET['order_by'])&&$_GET['order_by']!=''){
	switch ($_GET['order_by']) {
		case 'nombre_asc':     $order_by = 'ORDER BY card_listado.Nombre ASC ';             $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':    $order_by = 'ORDER BY card_listado.Nombre DESC ';            $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'tipo_asc':       $order_by = 'ORDER BY core_card_type.Nombre ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Tarjeta Ascendente';break;
		case 'tipo_desc':      $order_by = 'ORDER BY core_card_type.Nombre DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Tarjeta Descendente';break;
		case 'image_asc':      $order_by = 'ORDER BY core_sistemas_opciones.Nombre ASC ';   $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Uso Avatar Ascendente';break;
		case 'image_desc':     $order_by = 'ORDER BY core_sistemas_opciones.Nombre DESC ';  $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Uso Avatar Descendente';break;
		case 'posicion_asc':   $order_by = 'ORDER BY core_card_position.Nombre ASC ';       $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Posicion Texto Ascendente';break;
		case 'posicion_desc':  $order_by = 'ORDER BY core_card_position.Nombre DESC ';      $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Posicion Texto Descendente';break;
		
		default: $order_by = 'ORDER BY card_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY card_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';
}
/**********************************************************/
$z="WHERE card_listado.idCard >= 1";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){            $z .= " AND card_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idCardImage']) && $_GET['idCardImage'] != ''){  $z .= " AND card_listado.idCardImage=".$_GET['idCardImage'];}
if(isset($_GET['idCardType']) && $_GET['idCardType'] != ''){    $z .= " AND card_listado.idCardType=".$_GET['idCardType'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT card_listado.idCard FROM `card_listado` ".$z;
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
card_listado.idCard,
card_listado.Nombre AS CardNombre,
card_listado.Direccion_img,
core_sistemas_opciones.Nombre AS Imagen,
core_card_type.Nombre AS Tipo,
core_card_position.Nombre AS Posicion

FROM `card_listado`
LEFT JOIN `core_sistemas_opciones`  ON core_sistemas_opciones.idOpciones   = card_listado.idCardImage
LEFT JOIN `core_card_type`          ON core_card_type.idCardType           = card_listado.idCardType
LEFT JOIN `core_card_position`      ON core_card_position.idPosition       = card_listado.idPosition
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
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear Tarjeta</a><?php } ?>

</div>
<div class="clearfix"></div> 
<div class="collapse col-sm-12" id="collapseExample">
	<div class="well">
		<div class="col-sm-8 fcenter">
			<form class="form-horizontal" id="form1" name="form1" action="<?php echo $location; ?>" novalidate>
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {        $x1  = $Nombre;          }else{$x1  = '';}
				if(isset($idCardImage)) {   $x2  = $idCardImage;     }else{$x2  = '';}
				if(isset($idCardType)) {    $x3  = $idCardType;      }else{$x3  = '';}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				$Form_Imputs->form_select_filter('Uso Avatar','idCardImage', $x2, 1, 'idCardImage', 'Nombre', 'core_card_image', 0, '', $dbConn);
				$Form_Imputs->form_select_filter('Posicion Texto','idCardType', $x3, 1, 'idCardType', 'Nombre', 'core_card_type', 0, '', $dbConn);
				
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de Tipos de tarjeta</h5>
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
						<th width="70">Foto</th>
						<th>
							<div class="pull-left">Nombre</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Uso Avatar</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=image_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=image_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tipo Tarjeta</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Posicion Texto</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=posicion_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=posicion_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th width="10">Acciones</th>
					</tr>
				</thead>
				<tbody role="alert" aria-live="polite" aria-relevant="all">
				<?php foreach ($arrProductos as $prod) { ?>
					<tr class="odd">
						<td>
							<?php if ($prod['Direccion_img']=='') { ?>
								<img class="img-round" src="<?php echo DB_SITE ?>/LIB_assets/img/productos.jpg" style="height:30px; width:50px;">
							<?php }else{
								echo '<img class="img-round" src="upload/'.$prod['Direccion_img'].'" style="height:30px; width:50px;">';
							}?>
						</td>
						<td><?php echo $prod['CardNombre']; ?></td>
						<td><?php echo $prod['Imagen']; ?></td>
						<td><?php echo $prod['Tipo']; ?></td>
						<td><?php echo $prod['Posicion']; ?></td>
						<td>
							<div class="btn-group" style="width: 70px;" >
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$prod['idCard']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$prod['idCard'];
									$dialogo   = '¿Realmente deseas eliminar el '.$x_column_producto_nombre_sing.' '.$prod['CardNombre'].'?';?>
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
