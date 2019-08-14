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
//Se agregan ubicaciones
$location .='?pagina='.$_GET['pagina'];
/********************************************************************/
//Variables para filtro y paginacion
$search = '';
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                  $location .= "&Nombre=".$_GET['Nombre'];                   $search .= "&Nombre=".$_GET['Nombre'];}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                  $location .= "&idTipo=".$_GET['idTipo'];                   $search .= "&idTipo=".$_GET['idTipo'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $location .= "&idCategoria=".$_GET['idCategoria'];         $search .= "&idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['Marca']) && $_GET['Marca'] != ''){                    $location .= "&Marca=".$_GET['Marca'];                     $search .= "&Marca=".$_GET['Marca'];}
if(isset($_GET['idUml']) && $_GET['idUml'] != ''){                    $location .= "&idUml=".$_GET['idUml'];                     $search .= "&idUml=".$_GET['idUml'];}
if(isset($_GET['idTipoProducto']) && $_GET['idTipoProducto'] != ''){  $location .= "&idTipoProducto=".$_GET['idTipoProducto'];   $search .= "&idTipoProducto=".$_GET['idTipoProducto'];}
if(isset($_GET['idTipoReceta']) && $_GET['idTipoReceta'] != ''){      $location .= "&idTipoReceta=".$_GET['idTipoReceta'];       $search .= "&idTipoReceta=".$_GET['idTipoReceta'];}
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
	require_once 'A1XRXS_sys/xrxs_form/productos_listado.php';
}
//se borra un dato
if ( !empty($_GET['del']) )     {
	//Llamamos al formulario
	$form_trabajo= 'del';
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
if (isset($_GET['created'])) {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' Creado correctamente';}
if (isset($_GET['edited']))  {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' Modificado correctamente';}
if (isset($_GET['deleted'])) {$error['usuario'] 	  = 'sucess/'.$x_column_producto_nombre_sing.' borrado correctamente';}
//Manejador de errores
if(isset($error)&&$error!=''){echo notifications_list($error);};?>
<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
if ( ! empty($_GET['id']) ) { 
// Se traen todos los datos de mi usuario
$query = "SELECT 
productos_listado.Nombre,
productos_listado.Descripcion,
productos_listado.Marca,
productos_listado.Codigo,
productos_listado.StockLimite,
productos_listado.ValorIngreso,
productos_listado.ValorEgreso,
productos_listado.Direccion_img,
productos_listado.idTipoImagen,
productos_listado.idTipoReceta,
productos_listado.idOpciones_1,
productos_listado.idOpciones_2,
productos_listado.IngredienteActivo, 
productos_listado.Carencia, 
productos_listado.DosisRecomendada, 
productos_listado.EfectoResidual, 
productos_listado.EfectoRetroactivo,
productos_listado.CarenciaExportador,
sistema_productos_categorias.Nombre AS Categoria,
sistema_productos_tipo.Nombre AS Tipo,
core_tipo_producto.Nombre AS TipoProd,
sistema_productos_uml.Nombre AS Unidad,
productos_listado.FichaTecnica,
productos_listado.HDS,
productos_listado.idTipoProducto,
core_estados.Nombre AS Estado,
core_maquinas_tipo.Nombre AS Tarea,
proveedor_listado.Nombre AS ProveedorFijo,
cross_quality_calidad_matriz.Nombre AS MatrizCalidad,
ops1.Nombre AS SistemaMantenlubric,
ops2.Nombre AS SistemaCROSS

FROM `productos_listado`
LEFT JOIN `sistema_productos_tipo`           ON sistema_productos_tipo.idTipo                    = productos_listado.idTipo
LEFT JOIN `sistema_productos_categorias`     ON sistema_productos_categorias.idCategoria         = productos_listado.idCategoria
LEFT JOIN `sistema_productos_uml`            ON sistema_productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `core_tipo_producto`               ON core_tipo_producto.idTipoProducto                = productos_listado.idTipoProducto
LEFT JOIN `core_estados`                     ON core_estados.idEstado                            = productos_listado.idEstado
LEFT JOIN `core_maquinas_tipo`               ON core_maquinas_tipo.idSubTipo                     = productos_listado.idSubTipo
LEFT JOIN `proveedor_listado`                ON proveedor_listado.idProveedor                    = productos_listado.idProveedorFijo
LEFT JOIN `cross_quality_calidad_matriz`     ON cross_quality_calidad_matriz.idMatriz            = productos_listado.idCalidad
LEFT JOIN `core_sistemas_opciones` ops1      ON ops1.idOpciones                                  = productos_listado.idOpciones_1
LEFT JOIN `core_sistemas_opciones` ops2      ON ops2.idOpciones                                  = productos_listado.idOpciones_2

WHERE productos_listado.idProducto = {$_GET['id']}";
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

//Se verifica el tipo de producto para traer su receta
if(isset($rowdata['idTipoProducto'])&&$rowdata['idTipoProducto']==2){
	// Se trae un listado con productos de la receta
	$arrRecetas = array();
	$query = "SELECT 
	productos_listado.Nombre AS NombreProd,
	productos_recetas.Cantidad,
	sistema_productos_uml.Nombre AS UnidadMedida
	FROM `productos_recetas`
	LEFT JOIN `productos_listado`        ON productos_listado.idProducto     = productos_recetas.idProductoRel
	LEFT JOIN `sistema_productos_uml`    ON sistema_productos_uml.idUml      = productos_listado.idUml
	WHERE productos_recetas.idProducto = {$_GET['id']}";
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
	array_push( $arrRecetas,$row );
	}
}
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
				<li class="active"><a href="<?php echo 'productos_listado.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Resumen</a></li>
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
						<li class=""><a href="<?php echo 'productos_listado_datos_imagen.php?pagina='.$_GET['pagina'].'&id='.$_GET['id']?>" >Imagen</a></li>
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
						
						}?>
					</div>
					<div class="col-sm-8">
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos de <?php echo $x_column_producto_nombre_sing; ?></h2>
						<p class="text-muted">
							<strong>Nombre : </strong><?php echo $rowdata['Nombre']; ?><br/>
							<strong>Marca : </strong><?php echo $rowdata['Marca']; ?><br/>
							<strong>Codigo : </strong><?php echo $rowdata['Codigo']; ?><br/>
							<strong><?php echo $x_column_producto_cat_sing; ?> : </strong><?php echo $rowdata['Categoria']; ?><br/>
							<strong><?php echo $x_column_producto_tipo_sing; ?> : </strong><?php echo $rowdata['Tipo']; ?><br/>
							<strong>Tipo de Producto : </strong><?php echo $rowdata['TipoProd']; ?><br/>
							<strong>Unidad de medida : </strong><?php echo $rowdata['Unidad']; ?><br/>
							<strong>Estado : </strong><?php echo $rowdata['Estado']; ?><br/>
							
							<strong>Ingredientes Activos : </strong><br/><?php echo $rowdata['IngredienteActivo']; ?><br/>
							<strong>Carencia : </strong><?php echo $rowdata['Carencia']; ?><br/>
							<strong>Dosis Recomendada : </strong><?php echo Cantidades_decimales_justos($rowdata['DosisRecomendada']); ?><br/>
							<strong>Efecto Residual : </strong><?php echo Cantidades_decimales_justos($rowdata['EfectoResidual']); ?><br/>
							<strong>Efecto Retroactivo : </strong><?php echo Cantidades_decimales_justos($rowdata['EfectoRetroactivo']); ?><br/>
							<strong>Carencia Exportador : </strong><?php echo Cantidades_decimales_justos($rowdata['CarenciaExportador']); ?><br/>

						</p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Configuracion</h2>
						<p class="text-muted">
							<strong>Sistema Mantenlubric : </strong><?php echo $rowdata['SistemaMantenlubric']; ?><br/>
							<strong>Sistema CROSS: </strong><?php echo $rowdata['SistemaCROSS']; ?><br/>
						</p>
						
						<?php if(isset($rowdata['idOpciones_1'])&&$rowdata['idOpciones_1']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Sistema Mantenlubric</h2>
							<p class="text-muted">
								<strong>Tareas Relacionadas : </strong><?php echo $rowdata['Tarea']; ?>
							</p>
						<?php } ?>
						<?php if(isset($rowdata['idOpciones_2'])&&$rowdata['idOpciones_2']==1){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Sistema Cross</h2>
							<p class="text-muted">
								<strong>Tipo Planilla de Calidad : </strong><?php echo $rowdata['MatrizCalidad']; ?><br/>
							</p>
						<?php } ?>
						

						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Descripcion</h2>
						<p class="text-muted"><?php echo $rowdata['Descripcion']; ?></p>
						
						<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Datos Comerciales</h2>
						<p class="text-muted">
							<strong>Proveedor predefinido : </strong><?php echo $rowdata['ProveedorFijo']; ?><br/>
							<strong>Stock Minimo : </strong><?php echo Cantidades_decimales_justos($rowdata['StockLimite']).' '.$rowdata['Unidad']; ?><br/>
							<strong>Valor promedio Ingreso : </strong><?php echo Valores(Cantidades_decimales_justos($rowdata['ValorIngreso']), 0); ?><br/>
							<strong>Valor promedio Egreso : </strong><?php echo Valores(Cantidades_decimales_justos($rowdata['ValorEgreso']), 0); ?><br/>
						</p>
						
						<?php if(isset($rowdata['idTipoProducto'])&&$rowdata['idTipoProducto']==2){ ?>
							<h2 class="text-primary"><i class="fa fa-list" aria-hidden="true"></i> Receta</h2>
							<table  class="table table-bordered">
								<?php 
								$total = 0;
								foreach ($arrRecetas as $receta) {
									$total = $total + $receta['Cantidad']; ?>
									<tr class="item-row">
										<td><?php echo $receta['NombreProd']; ?></td>
										<td width="90"><?php echo Cantidades_decimales_justos_alt($receta['Cantidad']).' '.$receta['UnidadMedida'];?></td>
									</tr>
								<?php }?>
							</table>
						<?php } ?>
						
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
			<h5>Crear <?php echo $x_column_producto_nombre_sing; ?></h5>
		</header>
		<div id="div-1" class="body">
			<form class="form-horizontal" method="post" id="form1" name="form1" novalidate>
        	
				<?php 
				//Se verifican si existen los datos
				if(isset($Nombre)) {         $x1  = $Nombre;           }else{$x1  = '';}
				if(isset($idTipo)) {         $x2  = $idTipo;           }else{$x2  = '';}
				if(isset($idCategoria)) {    $x3  = $idCategoria;      }else{$x3  = '';}
				if(isset($Marca)) {          $x4  = $Marca;            }else{$x4  = '';}
				if(isset($idUml)) {          $x5  = $idUml;            }else{$x5  = '';}
				if(isset($idTipoProducto)) { $x6  = $idTipoProducto;   }else{$x6  = '';}
				if(isset($idTipoReceta)) {   $x7  = $idTipoReceta;     }else{$x7  = '';}
				if(isset($idSubTipo)) {      $x8  = $idSubTipo;        }else{$x8  = '';}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 2);
				$Form_Imputs->form_select_filter($x_column_producto_tipo_sing,'idTipo', $x2, 2, 'idTipo', 'Nombre', 'sistema_productos_tipo', 0, '', $dbConn);
				$Form_Imputs->form_select_filter($x_column_producto_cat_sing,'idCategoria', $x3, 2, 'idCategoria', 'Nombre', 'sistema_productos_categorias', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Marca', 'Marca', $x4, 1);
				$Form_Imputs->form_select_filter('Unidad de Medida','idUml', $x5, 2, 'idUml', 'Nombre', 'sistema_productos_uml', 0, '', $dbConn);
				$Form_Imputs->form_select('Tipo Producto','idTipoProducto', $x6, 2, 'idTipoProducto', 'Nombre', 'core_tipo_producto', 0, '', $dbConn);
				$Form_Imputs->form_select('Tipo de Receta','idTipoReceta', $x7, 1, 'idTipoReceta', 'Nombre', 'core_tipo_receta', 0, '', $dbConn);
				//$Form_Imputs->form_select('Tareas Relacionadas','idSubTipo', $x8, 2, 'idSubTipo', 'Nombre', 'core_maquinas_tipo', 0, '', $dbConn);
					
				$Form_Imputs->form_input_hidden('idEstado', 1, 2);
				$Form_Imputs->form_input_hidden('idOpciones_1', 2, 2);
				$Form_Imputs->form_input_hidden('idOpciones_2', 2, 2);
				?>
				
				
				<script>
					document.getElementById('div_idTipoReceta').style.display = 'none';
					
					var modelSelected = 0;
					
					$(document).ready(function(){ //se ejecuta al cargar la página (OBLIGATORIO)
						
						$("#idTipoProducto").on("change", function(){ //se ejecuta al cambiar valor del select
							modelSelected= $("#idTipoProducto").val();//Asignamos el valor seleccionado
							
							
							//Materia prima
							if(modelSelected == 1){ 
								document.getElementById('div_idTipoReceta').style.display = 'none';
								
								//selecciono el select
								var select = document.getElementById('idTipoReceta');
								//lo vacio
								select.length = 1
								select.options[0].value = "0"
								select.options[0].text = "Seleccione una Opcion"
							
							//Producto Terminado	
							} else if(modelSelected == 2){ 
								document.getElementById('div_idTipoReceta').style.display = '';
								
								//selecciono el select
								var select = document.getElementById('idTipoReceta');
								//lo vacio
								select.length = 3
								select.options[0].value = "0"
								select.options[0].text = "Seleccione una Opcion"
								select.options[1].value = "1"
								select.options[1].text = "Por Porcentaje total"
								select.options[2].value = "2"
								select.options[2].text = "Libre"
								
							} else { 
								document.getElementById('div_idTipoReceta').style.display = 'none';
								
							}
						
						}); 
					}); 
					
				</script>
					
					
					
					
					
				
				
				
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
		case 'nombre_asc':      $order_by = 'ORDER BY productos_listado.Nombre ASC ';               $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Nombre Ascendente';break;
		case 'nombre_desc':     $order_by = 'ORDER BY productos_listado.Nombre DESC ';              $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Nombre Descendente';break;
		case 'categoria_asc':   $order_by = 'ORDER BY sistema_productos_categorias.Nombre ASC ';    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> '.$x_column_producto_cat_sing.' Ascendente';break;
		case 'categoria_desc':  $order_by = 'ORDER BY sistema_productos_categorias.Nombre DESC ';   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> '.$x_column_producto_cat_sing.' Descendente';break;
		case 'tipo_asc':        $order_by = 'ORDER BY sistema_productos_tipo.Nombre ASC ';          $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> '.$x_column_producto_tipo_sing.' Ascendente';break;
		case 'tipo_desc':       $order_by = 'ORDER BY sistema_productos_tipo.Nombre DESC ';         $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> '.$x_column_producto_tipo_sing.' Descendente';break;
		case 'unidad_asc':      $order_by = 'ORDER BY sistema_productos_uml.Nombre ASC ';           $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Unidad Medida Ascendente';break;
		case 'unidad_desc':     $order_by = 'ORDER BY sistema_productos_uml.Nombre DESC ';          $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Unidad Medida Descendente';break;
		case 'tipoprod_asc':    $order_by = 'ORDER BY core_tipo_producto.Nombre ASC ';              $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo Producto Ascendente';break;
		case 'tipoprod_desc':   $order_by = 'ORDER BY core_tipo_producto.Nombre DESC ';             $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Tipo Producto Descendente';break;
		case 'estado_asc':      $order_by = 'ORDER BY core_estados.Nombre ASC ';                    $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Estado Ascendente';break;
		case 'estado_desc':     $order_by = 'ORDER BY core_estados.Nombre DESC ';                   $bread_order = '<i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> Estado Descendente';break;
		
		default: $order_by = 'ORDER BY sistema_productos_tipo.Nombre ASC, productos_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo, Nombre Ascendente';
	}
}else{
	$order_by = 'ORDER BY sistema_productos_tipo.Nombre ASC, productos_listado.Nombre ASC '; $bread_order = '<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Tipo, Nombre Ascendente';
}
/**********************************************************/
$z="WHERE productos_listado.idProducto >= 1";
/**********************************************************/
//Se aplican los filtros
if(isset($_GET['Nombre']) && $_GET['Nombre'] != ''){                  $z .= " AND productos_listado.Nombre LIKE '%".$_GET['Nombre']."%'";}
if(isset($_GET['idTipo']) && $_GET['idTipo'] != ''){                  $z .= " AND productos_listado.idTipo=".$_GET['idTipo'];}
if(isset($_GET['idCategoria']) && $_GET['idCategoria'] != ''){        $z .= " AND productos_listado.idCategoria=".$_GET['idCategoria'];}
if(isset($_GET['Marca']) && $_GET['Marca'] != ''){                    $z .= " AND productos_listado.Marca LIKE '%".$_GET['Marca']."%'";}
if(isset($_GET['idUml']) && $_GET['idUml'] != ''){                    $z .= " AND productos_listado.idUml=".$_GET['idUml'];}
if(isset($_GET['idTipoProducto']) && $_GET['idTipoProducto'] != ''){  $z .= " AND productos_listado.idTipoProducto=".$_GET['idTipoProducto'];}
if(isset($_GET['idTipoReceta']) && $_GET['idTipoReceta'] != ''){      $z .= " AND productos_listado.idTipoReceta=".$_GET['idTipoReceta'];}
if(isset($_GET['idSubTipo']) && $_GET['idSubTipo'] != ''){            $z .= " AND productos_listado.idSubTipo=".$_GET['idSubTipo'];}
if(isset($_GET['idEstado']) && $_GET['idEstado'] != ''){              $z .= " AND productos_listado.idEstado=".$_GET['idEstado'];}
/**********************************************************/
//Realizo una consulta para saber el total de elementos existentes
$query = "SELECT productos_listado.idProducto FROM `productos_listado` ".$z;
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
productos_listado.idProducto,
productos_listado.Nombre AS NombreProd,
productos_listado.Direccion_img,
productos_listado.idTipoImagen,
sistema_productos_tipo.Nombre AS Tipo,
sistema_productos_categorias.Nombre AS Categoria,
sistema_productos_uml.Nombre AS UnidadMedida,
core_tipo_producto.Nombre AS TipoProd,
core_estados.Nombre AS Estado,
productos_listado.idEstado

FROM `productos_listado`
LEFT JOIN `sistema_productos_tipo`           ON sistema_productos_tipo.idTipo                    = productos_listado.idTipo
LEFT JOIN `sistema_productos_categorias`     ON sistema_productos_categorias.idCategoria         = productos_listado.idCategoria
LEFT JOIN `sistema_productos_uml`            ON sistema_productos_uml.idUml                      = productos_listado.idUml
LEFT JOIN `core_tipo_producto`               ON core_tipo_producto.idTipoProducto                = productos_listado.idTipoProducto
LEFT JOIN `core_estados`                     ON core_estados.idEstado                            = productos_listado.idEstado
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
	
	<?php if ($rowlevel['level']>=3){?><a href="<?php echo $location; ?>&new=true" class="btn btn-default fright margin_width fmrbtn" ><i class="fa fa-file-o" aria-hidden="true"></i> Crear <?php echo $x_column_producto_nombre_sing; ?></a><?php } ?>

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
				if(isset($Marca)) {          $x4  = $Marca;            }else{$x4  = '';}
				if(isset($idUml)) {          $x5  = $idUml;            }else{$x5  = '';}
				if(isset($idTipoProducto)) { $x6  = $idTipoProducto;   }else{$x6  = '';}
				if(isset($idTipoReceta)) {   $x7  = $idTipoReceta;     }else{$x7  = '';}
				if(isset($idSubTipo)) {      $x8  = $idSubTipo;        }else{$x8  = '';}
				if(isset($idEstado)) {       $x9  = $idEstado;         }else{$x9  = '';}
					
				//se dibujan los inputs
				$Form_Imputs = new Form_Inputs();
				$Form_Imputs->form_input_text( 'Nombre', 'Nombre', $x1, 1);
				$Form_Imputs->form_select_filter($x_column_producto_tipo_sing,'idTipo', $x2, 1, 'idTipo', 'Nombre', 'sistema_productos_tipo', 0, '', $dbConn);
				$Form_Imputs->form_select_filter($x_column_producto_cat_sing,'idCategoria', $x3, 1, 'idCategoria', 'Nombre', 'sistema_productos_categorias', 0, '', $dbConn);
				$Form_Imputs->form_input_text( 'Marca', 'Marca', $x4, 1);
				$Form_Imputs->form_select_filter('Unidad de Medida','idUml', $x5, 1, 'idUml', 'Nombre', 'sistema_productos_uml', 0, '', $dbConn);
				$Form_Imputs->form_select('Tipo Producto','idTipoProducto', $x6, 1, 'idTipoProducto', 'Nombre', 'core_tipo_producto', 0, '', $dbConn);
				$Form_Imputs->form_select('Tipo de Receta','idTipoReceta', $x7, 1, 'idTipoReceta', 'Nombre', 'core_tipo_receta', 0, '', $dbConn);
				$Form_Imputs->form_select('Tareas Relacionadas','idSubTipo', $x8, 1, 'idSubTipo', 'Nombre', 'core_maquinas_tipo', 0, '', $dbConn);
				$Form_Imputs->form_select('Estado','idEstado', $x9, 1, 'idEstado', 'Nombre', 'core_estados', 0, '', $dbConn);
				
				
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
			<div class="icons"><i class="fa fa-table"></i></div><h5>Listado de <?php echo $x_column_producto_nombre_plur; ?></h5>
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
							<div class="pull-left"><?php echo $x_column_producto_cat_sing; ?></div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=categoria_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=categoria_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left"><?php echo $x_column_producto_tipo_sing; ?></div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipo_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=tipo_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
							</div>
						</th>
						<th>
							<div class="pull-left">Tipo Prod</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=tipoprod_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=tipoprod_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
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
							<div class="pull-left">Unidad Medida</div>
							<div class="btn-group pull-right" style="width: 50px;" >
								<a href="<?php echo $location.'&order_by=unidad_asc'; ?>" title="Ascendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-asc"></i></a>
								<a href="<?php echo $location.'&order_by=unidad_desc'; ?>" title="Descendente" class="btn btn-default btn-xs tooltip"><i class="fa fa-sort-alpha-desc"></i></a>
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
						<td>
							<?php if ($prod['Direccion_img']=='') { ?>
								<img class="img-round" src="<?php echo DB_SITE ?>/LIB_assets/img/productos.jpg" style="height:30px; width:50px;">
							<?php }else{
								//se selecciona el tipo de imagen
								switch ($prod['idTipoImagen']) {
									//Si no esta configurada
									case 0:
										echo '<img class="img-round" src="upload/'.$prod['Direccion_img'].'" style="height:30px; width:50px;">';
										break;
									//Normal
									case 1:
										echo '<img class="img-round" src="upload/'.$prod['Direccion_img'].'" style="height:30px; width:50px;">';
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
									case 11:
									case 12:
									case 13:
									case 14:
									case 15:
									case 16:
									case 17:
									case 18:
										echo '<img class="img-round" src="'.DB_SITE.'/LIB_assets/img/3dcube.jpg" style="height:30px; width:50px;">';
										break;
										
								}
							
							}?>
						</td>
						<td><?php echo $prod['Categoria']; ?></td>
						<td><?php echo $prod['Tipo']; ?></td>
						<td><?php echo $prod['TipoProd']; ?></td>
						<td><?php echo $prod['NombreProd']; ?></td>
						<td><?php echo $prod['UnidadMedida']; ?></td>
						<td><label class="label <?php if(isset($prod['idEstado'])&&$prod['idEstado']==1){echo 'label-success';}else{echo 'label-danger';}?>"><?php echo $prod['Estado']; ?></label></td>
						<td>
							<div class="btn-group" style="width: 105px;" >
								<?php if ($rowlevel['level']>=1){?><a href="<?php echo 'view_productos.php?view='.$prod['idProducto']; ?>" title="Ver Informacion" class="iframe btn btn-primary btn-sm tooltip"><i class="fa fa-list"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=2){?><a href="<?php echo $location.'&id='.$prod['idProducto']; ?>" title="Editar Informacion" class="btn btn-success btn-sm tooltip"><i class="fa fa-pencil-square-o"></i></a><?php } ?>
								<?php if ($rowlevel['level']>=4){
									$ubicacion = $location.'&del='.$prod['idProducto'];
									$dialogo   = '¿Realmente deseas eliminar el '.$x_column_producto_nombre_sing.' '.$prod['NombreProd'].'?';?>
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
