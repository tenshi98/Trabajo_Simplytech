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
$original = "productos_listado.php";
$location = $original;
$new_location = "productos_listado_datos_imagen.php";
$new_location .='?pagina='.$_GET['pagina'];
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
//Verifico los permisos del usuario sobre la transaccion
require_once '../A2XRXS_gears/xrxs_configuracion/Load.User.Permission.php';
/**********************************************************************************************************************************/
/*                                          Se llaman a las partes de los formularios                                             */
/**********************************************************************************************************************************/
//formulario para editar
if ( !empty($_POST['submit_edit']) )  { 
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'submit_img';
	require_once 'A1XRXS_sys/xrxs_form/productos_listado.php';
}
//se borra un dato
if ( !empty($_GET['del_img']) )     {
	//Nueva ubicacion
	$location = $new_location;
	$location.='&id='.$_GET['id'];
	//Llamamos al formulario
	$form_trabajo= 'del_img';
	require_once 'A1XRXS_sys/xrxs_form/productos_listado.php';	
}
/**********************************************************************************************************************************/
/*                                         Se llaman a la cabecera del documento html                                             */
/**********************************************************************************************************************************/
require_once 'core/Web.Header.Main.php';
/**********************************************************************************************************************************/
/*                                                   ejecucion de logica                                                          */
/**********************************************************************************************************************************/
//Listado de errores no manejables
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' editado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
// Se traen todos los datos del producto
$query = "SELECT Nombre,Direccion_img, idTipoProducto, idTipoReceta,idTipoImagen,idOpciones_1, idOpciones_2
FROM `productos_listado`
WHERE idProducto = {$_GET['id']}";
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
				<span class="info-box-text"><?php echo $x_column_producto_nombre_plur; ?></span>
				<span class="info-box-number"><?php echo $rowdata['Nombre']; ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">Editar Imagen</span>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>


<div class="col-sm-12">
	<div class="box">
		<header>
			<ul class="nav nav-tabs pull-right">
				<li class=""><a href="<?php echo 'productos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
				<li class=""><a href="<?php echo 'productos_listado_datos.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Basicos</a></li>
				<li class=""><a href="<?php echo 'productos_listado_datos_descripcion.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Descripcion</a></li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">Ver mas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class=""><a href="<?php echo 'productos_listado_datos_opciones.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Opciones</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_comerciales.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Datos Comerciales</a></li>
						<?php if(isset($rowdata['idTipoProducto'])&&$rowdata['idTipoProducto']==2&&$rowdata['idTipoReceta']==1){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_receta_01.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Receta</a></li>
						<?php }elseif(isset($rowdata['idTipoProducto'])&&$rowdata['idTipoProducto']==2&&$rowdata['idTipoReceta']==2){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_receta_02.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Receta</a></li>
						<?php } ?>
						<li class=""><a href="<?php echo 'productos_listado_datos_estado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Estado</a></li>
						<li class="active"><a href="<?php echo 'productos_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_ficha.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Ficha</a></li>
						<li class=""><a href="<?php echo 'productos_listado_datos_hds.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >HDS</a></li>
						<?php if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_ot.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Sistema Mantenlubric</a></li>
						<?php } ?>
						<?php if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
							<li class=""><a href="<?php echo 'productos_listado_datos_cross.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Sistema CROSS</a></li>
						<?php } ?>
						
					</ul>
                </li>           
			</ul>	
		</header>
        <div class="table-responsive">
			<div class="col-sm-8 fcenter" style="padding-top:40px;">
				
				<?php if(isset($rowdata['Direccion_img'])&&$rowdata['Direccion_img']!=''){?>
        
					<div class="col-sm-12 fcenter">
						<?php
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
								case 3:
								case 4:
								case 5:
								case 6:
								case 7:
								case 8:
								case 9:
								case 10:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/prefixfree/prefixfree.min.js"></script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/drum.js"></script>';
									echo '<script>
										var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";	
										document.getElementById("cover_prod").appendChild(createBarrel(textura));
									</script>';
									break;
								//Cubo Carton 1x1x1
								case 11:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 10;</script>';
									echo '<script>var med_largo = 10;</script>';
									echo '<script>var med_ancho = 10;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
									break;
									
								//Cubo Carton 2x1x1
								case 12:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 30;</script>';
									echo '<script>var med_largo = 5;</script>';
									echo '<script>var med_ancho = 5;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
									break;
								//Cubo Carton 1x2x1
								case 13:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 5;</script>';
									echo '<script>var med_largo = 10;</script>';
									echo '<script>var med_ancho = 5;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
									break;
								//Cubo Carton 2x2x1
								case 14:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 10;</script>';
									echo '<script>var med_largo = 10;</script>';
									echo '<script>var med_ancho = 5;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
									break;
								//Cubo Madera 1x1x1
								case 15:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 10;</script>';
									echo '<script>var med_largo = 10;</script>';
									echo '<script>var med_ancho = 10;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
									break;
									
								//Cubo Madera 2x1x1
								case 16:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 30;</script>';
									echo '<script>var med_largo = 5;</script>';
									echo '<script>var med_ancho = 5;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
									break;
								//Cubo Madera 1x2x1
								case 17:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 5;</script>';
									echo '<script>var med_largo = 10;</script>';
									echo '<script>var med_ancho = 5;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:300px;}</style>';
									break;
								//Cubo Madera 2x2x1
								case 18:
									echo '<div class="fcenter" id="cover_prod"></div>';
									echo '<script src="'.DB_SITE.'/LIBS_js/three_js/three.min.js"></script>';
									echo '<script>var textura = "'.DB_SITE.DB_EMPRESA_PATH.'/upload/'.$rowdata['Direccion_img'].'";</script>';
									echo '<script>var med_alto  = 10;</script>';
									echo '<script>var med_largo = 10;</script>';
									echo '<script>var med_ancho = 5;</script>';
									echo '<script src="'.DB_SITE.'/LIBS_js/3d_cover/cube_normal.js"></script>';
									echo '<style>#cover_prod canvas{margin-top: 10px;background-color: #eeeeee;}#cover_prod{height:600px;}</style>';
									break;
									
									
							}
						
						?>
					</div> 
					<a href="<?php echo $new_location.'&id='.$_GET['id'].'&del_img='.$_GET['id']; ?>" class="btn btn-danger fright margin_width" style="margin-top:10px;margin-bottom:10px;"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Imagen</a>
					<div class="clearfix"></div>
					
				<?php }else{?>

					<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form1" name="form1" novalidate>
					
						<?php 
						//se dibujan los inputs
						$Form_Imputs = new Form_Inputs();
						$Form_Imputs->form_multiple_upload('Seleccionar archivo','Direccion_img', 1, '"jpg", "png", "gif", "jpeg"');
						
						if(isset($idTipoImagen)) {  $x1  = $idTipoImagen;  }else{$x1  = '';}
						
						$Form_Imputs->form_select('Tipo Imagen','idTipoImagen', $x1, 2, 'idTipoImagen', 'Nombre', 'core_tipo_producto_imagen', 0, '', $dbConn);
						
						$Form_Imputs->form_input_hidden('idProducto', $_GET['id'], 2);
						?> 

						<div class="form-group">
							<input type="submit" class="btn btn-primary fright margin_width fa-input" value="&#xf093; Subir Archivo" name="submit_edit"> 
						</div>
							  
					</form> 
					<?php require_once '../LIBS_js/validator/form_validator.php';?>
				<?php }?> 
				
				
				
			</div>
		</div>	
	</div>
</div>

<div class="clearfix"></div>
<div class="col-sm-12 fcenter" style="margin-bottom:30px">
<a href="<?php echo $location ?>" class="btn btn-danger fright"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Volver</a>
<div class="clearfix"></div>
</div>


<?php
/**********************************************************************************************************************************/
/*                                             Se llama al pie del documento html                                                 */
/**********************************************************************************************************************************/
require_once 'core/Web.Footer.Main.php';
?>
